<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\SessionGuard;
use App\Http\Requests\PaymentRequest;
use App\Http\Traits\Districts;
use App\Http\Traits\Paypal;
use App\Http\Traits\Ssl;
use App\Package;
use App\deliverydate;
use App\Product;
use App\Promotion;
use App\SaleItem;
use App\Sales;
use App\ShippingCost;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;

use App\StoreIntial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Payment;


class PaymentController extends Controller
{

    use  Ssl, Districts;

    public function paymentConfirmation(Request $request)
    {
        if (auth()->user()) {
            $user = User::with('contact')->find(auth()->user()->id);
        }
        else
        {
            $user=null;
        }

        $districts = $this->getDistricts();

        $promotion = 0;
        if ($request->input('pcode')) {
            $promotion = Promotion::whereCode($request->input('pcode'))->first();
            if (!$promotion) {
                $promotion = 0;
            } else {
                if ($promotion->at_least_amount > Cart::subtotal()) {
                    $promotion = 0;
                }
            }
        }
        $delivery =DB::table('deliverydates')
                    ->select('*')
                    ->where('deilivary_date','>=',DATE(NOW()))
                    ->where('quantity','>',0)
                    ->get();

        $cartItems = Cart::content();
        $shippingCost = ShippingCost::orderBy('id', 'desc')->first();
        return view('site.pages.cart.checkout', [
            'shippingCost' => $shippingCost,
            'cartItems' => $cartItems,
            'promotion' => $promotion,
            'districts' => $districts,
            'user' => $user,
            'delivery' => $delivery,
        ]);
    }

    public function makePayment(Request $request)
    {

        if(Cart::count() < 1) return redirect()->back()->with([
            'type' => 'error',
            'message' => 'First Select product to order'
        ]);

        $promotionCode = $request->input('package_code');
        $promotion = Promotion::whereCode($promotionCode)->first();
        $shippingCost = ShippingCost::orderBy('id', 'DESC')->first();
        $subTotal = str_replace(",","",Cart::subtotal());

        $grandTotal = 0;
        $promoId = null;
        $discount = 0;


        if ($promotion) {

            if ($promotion->at_least_amount <= $subTotal) {

                $promoId = $promotion->id;
                if ($promotion->sign == 'Amount') {
                    $discount = (float)$promotion->amount;
                    $grandTotal = ((float)$subTotal - (float)$promotion->amount) + $shippingCost->amount;

                } elseif ($promotion->sign == 'Percentage') {
                    $discount = (((float)$subTotal * (float)$promotion->amount) / 100);
                    $grandTotal = ((float)$subTotal - $discount) + (float)$shippingCost->amount;

                }
            } else {
                $grandTotal = (float)$subTotal + $shippingCost->amount;
            }
        } else {

            $grandTotal = (float)$subTotal + $shippingCost->amount;

        }

    if(auth()->user()) {
            
    $user = User::whereId(auth()->user()->id);
   
        $contact = Contact::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $request->except(['package_code','name', 'payment_method'])
        );

}
        if ($request->input('payment_method') == 'ssl') {
            $id=auth()->user()->id;
            $request->session()->put('id',$id);
            return $this->sslPayment($grandTotal, null, $promoId, 'product', $discount);
        }  elseif ($request->input('payment_method') == 'cash_on_delivery') {

            if(auth()->user()) {
                
                $orderNo = $this->makeSales($discount, (float)$shippingCost->amount, 'cash on delivery');
                $delivery=DB::table('deliverydates')
                    ->select('id','quantity')
                    ->where("deilivary_date",'=',$request->delivery_date)
                    ->get();
                $quantity=$delivery[0]->quantity-1;
                $date=deliverydate::find($delivery[0]->id);
                $date->quantity=$quantity;
                $date->save();

                Cart::destroy();
//                $mailData = [
//                    'name' => auth()->user()->name,
//                    'order_no' => $orderNo,
//                ];

//                $this->sendEmail('email.email-order-confirmation', $mailData, 'Order Confirmation', auth()->user()->email);
//                $this->sendEmail('email.email-admin-order-confirmation', $mailData, 'New Order', env('ADMIN_MAIL_ADDRESS'));
                return redirect('/user-details/all-order')->with([
                    'type' => 'success',
                    'message' => "Thank you " . auth()->user()->name . ", You order has been received.  
                A copy of invoice send to your E-mail: " . " and your Order no is ". $orderNo

                ]);
            }
            else{
                $year = Carbon::now()->year;
                $month = Carbon::now()->month;
                $orderCount = Sales::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)->count();
                $order_no = (string)($orderCount + 1);
                $order_no=strlen($order_no)>= 4 ? $order_no:strlen($order_no) == 3 ? '0'.$order_no :
                    strlen($order_no) == 2 ? '00'.$order_no: strlen($order_no) == 1 ?'000'.$order_no:'';
                $order_no =(int)(date("y").date("m").$order_no);

                $sales= Sales::create([
                    'order_no' => $order_no,
                    'user_id' => null,
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'post_code' => $request->post_code,
                    'city' => $request->city,
                    'district' => $request->district ,
                    'address' => $request->address,
                    'discount' => $discount,
                    'shipping_cost' =>  (float)$shippingCost->amount,
                    'payment_type' =>'cash on delivery',
                    'delivery_date' =>$request->delivery_date,
                ]);

                foreach (Cart::content() as $item){
                    SaleItem::create([
                        'sales_id' => $sales->id,
                        'product_id' => $item->id,
                        'quantity' => $item->qty,
                        'unit_price' => $item->price,
                        'total_price' => $item->price * (float)$item->qty,
                        'source' => $item->options['source'],
                        'source_id' => $item->options['source_id'],
                    ]);

                    $product= Product::find($item->id);
                    $product->update(['quantity' => $product->quantity - (int)$item->qty]);
                    $delivery=DB::table('deliverydates')
                        ->select('id','quantity')
                        ->where("deilivary_date",'=',$request->delivery_date)
                        ->get();
                    $quantity=$delivery[0]->quantity-1;
                    $date=deliverydate::find($delivery[0]->id);
                    $date->quantity=$quantity;
                    $date->save();

                    Cart::destroy();

                    return redirect('/all-products')->with([
                        'type' => 'success',
                        'message' => "Thank you " .$request->name . ", You order has been received.  
                A copy of invoice send to your E-mail: " . " and your Order no is ". $order_no

                    ]);
            }

        }
        } else {
            return redirect()->back();
        }
    }

    public function sslCreditPayment(Request $request)
    {
        $creditPayment = $this->prepareCreditPayment($request);
        return $this->sslPayment($request, $creditPayment[0], $creditPayment[1], $creditPayment[2], null, $creditPayment[3]);
    }




    public function prepareCreditPayment($request)
    {
        $packageId = $request->input('pid');
        $promotionCode = $request->input('pcode');
        $promotion = Promotion::whereCode($promotionCode)->first();

        $package = Package::find($packageId);
        $grandTotal = 0;
        $promoId = null;
        $discount = 0;

        if ($promotion) {
            if ($promotion->at_least_amount <= $package->price) {

                $promoId = $promotion->id;
                if ($promotion->sign == 'Amount') {
                    $discount = (float)$promotion->amount;
                    $grandTotal = (float)$package->price - $discount;

                } elseif ($promotion->sign == 'Percentage') {
                    $discount = (((float)$package->price * (float)$promotion->amount) / 100);
                    $grandTotal = (float)$package->price - $discount;


                }
            }
        } else {
            $grandTotal = (float)$package->price;
        }

        if ($grandTotal < 1) {
            return redirect()->back();
        }

        return [$grandTotal, $packageId, $promoId, $discount];

    }

    public function generateCreditInvoice($id)
    {
        $paymentInfo = \App\Payment::with('paymentable', 'user', 'promotion')->whereId($id)->first();
        if(!$paymentInfo) {
            return $this->invalidMessage();
        }
        if($check = $this->checkAuthenticate($paymentInfo->user_id)) return $check;
        return view('site.pages.payment.invoice')->with(['paymentInfo' => $paymentInfo]);
    }
    public function generateOrderInvoice($order_no)
    {
        $order = Sales::with('items.product','user')->whereOrderNo($order_no)->first();
        if(!$order) {
            return $this->invalidMessage();
        }

        return view('site.pages.payment.order-invoice',['order' => $order]);
    }

    public function makeSales($discount, $shippingCost, $payment_type) {


        $contact = Contact::whereUserId(auth()->user()->id)->first();

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $orderCount = Sales::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)->count();
        $order_no = (string)($orderCount + 1);
        $order_no=strlen($order_no)>= 4 ? $order_no:strlen($order_no) == 3 ? '0'.$order_no :
            strlen($order_no) == 2 ? '00'.$order_no: strlen($order_no) == 1 ?'000'.$order_no:'';
        $order_no =(int)(date("y").date("m").rand(10,100).rand(100,1000));
        
        $sales= Sales::create([
            'order_no' => $order_no,
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'mobile' => $contact->mobile,
            'post_code' => $contact->post_code,
            'city' => $contact->city,
            'district' => $contact->district ,
            'address' => $contact->address,
            'discount' => $discount,
            'shipping_cost' => $shippingCost,
            'payment_type' => $payment_type,
            'delivery_date' =>$contact->delivery_date,
        ]);
      
        foreach (Cart::content() as $item){
          SaleItem::create([
             'sales_id' => $sales->id,
             'product_id' => $item->id,
             'quantity' => $item->qty,
             'unit_price' => $item->price,
             'total_price' => $item->price * (float)$item->qty,
             'source' => $item->options['source'],
             'source_id' => $item->options['source_id'],
          ]);
        
          $product= Product::find($item->id);
          $product->update(['quantity' => $product->quantity - (int)$item->qty]);
        }

        return $order_no;
    }
    public function afterPaymentSsl()
    {

        $val_id = urlencode($_POST['val_id']);
        $store_id = urlencode(env('SSL_ID'));
        $store_passwd = urlencode(env('SSL_SECRET'));
        $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

        $result = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            # TO CONVERT AS ARRAY
            # $result = json_decode($result, true);
            # $status = $result['status'];
            # TO CONVERT AS OBJECT
            $result = json_decode($result);
            # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $bank_tran_id = $result->bank_tran_id;
            $card_type = $result->card_type;

            # EMI INFO
            $emi_instalment = $result->emi_instalment;
            $emi_amount = $result->emi_amount;
            $emi_description = $result->emi_description;
            $emi_issuer = $result->emi_issuer;

            # ISSUER INFO
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $card_issuer_country_code = $result->card_issuer_country_code;

            # API AUTHENTICATION
            $APIConnect = $result->APIConnect;
            $validated_on = $result->validated_on;
            $gw_version = $result->gw_version;

            $store = StoreIntial::whereId(1)->first();
                   
            if (!$store->data_3) {
                $pacakge = Package::find($store->data_1);

                $paymentInsert = \App\Payment::create([
                    'paymentable_id' => $store->data_1,
                    'paymentable_type' => "App\Package",
                    'amount' => $amount,
                    'discount_amount' => $store->data_4,
                    'promotion_id' => $store->data_2,
                    'payment_gateway' => 'Ssl',
                    'payment_method' => 'Ssl',
                    'credit' => 0,
                    'user_id' => auth()->user()->id
                ]);
                
                $orderNo = str_replace("-", "",
                    substr($paymentInsert->created_at, 0, 10));
                $paymentInsert->update(['order_no' => 'CR' . $orderNo . rand(10,100) . rand(100,1000)]);
                $user = User::whereId(auth()->user()->id);
                $user->update(['credit_balance' => auth()->user()->credit_balance + $pacakge->credit]);
                $creditEmailData = [
                    'name' => auth()->user()->name,
                    'order_no' => 'CR' . $orderNo . rand(10,100) . rand(100,1000),
                    'order_id' => $paymentInsert->id
                ];
                $this->sendEmail('email.email-credit-purchase', $creditEmailData, 'Credit Purchase Confirmation', auth()->user()->email);
                return redirect('/generate-invoice/' . $paymentInsert->id);
            } else {

                $shippingCost = ShippingCost::orderBy('id', 'DESC')->first();

                $orderNo = $this->makeSales($store->data_4, (float)$shippingCost->amount, 'ssl');


                Cart::destroy();
                $mailData = [
                    'name' => auth()->user()->name,
                    'order_no' => $orderNo,
                ];

//                $this->sendEmail('email.email-order-confirmation', $mailData,'Order Confirmation',  auth()->user()->email);
//                $this->sendEmail('email.email-admin-order-confirmation', $mailData,'New Order',  env('ADMIN_MAIL_ADDRESS'));
                return redirect('/user-details/all-order')->with([
                    'type' => 'success',
                    'message' => "Thank you " . auth()->user()->name . ", You order has been received.  
                A copy of invoice send to your E-mail: " . auth()->user()->email . " and your Order no is " . $orderNo
                ]);
            }

        } else {

            echo "Failed to connect with SSLCOMMERZ";
        }
    }

        public function failPaymentSsl()
    {
        return redirect('/user-home');
    }

        public function cancelPaymentSsl()
    {
        return redirect('/user-home');
    }
    public function generateOrderInvoiceAdmin($order_no)
    {
        $order = Sales::with('items.product','user')->whereOrderNo($order_no)->first();
        if(!$order) {
            return $this->invalidMessage();
        }

        return view('site.pages.payment.admin-order-invoice',['order' => $order]);
    }

}
