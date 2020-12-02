<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Http\Traits\Districts;
use App\Payment;
use App\Product;
use App\Sales;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserHomeController extends Controller
{
    use  Districts;
    public function index()
    {
        if(!auth()->user()){
            return redirect('/login');
        }

        $productList=DB::table('products')
            ->select('*')
            ->where('quantity','>', 0)
            ->where('status','=',1)
            ->paginate(20);


        $categories=DB::table('categories')
            ->select('*')
            ->where('status','=','Active')
            ->get();

        $subcat=DB::table('subcats')
            ->select('id','name','category_id')
            ->get();
        $subsub=DB::table('subsubs')
            ->select('*')
            ->get();

//        return view('site.pages.product.allProducts',['categories'=>$categories,'productList'=>$productList]);
        return view('site.home-partials.products',['categories'=>$categories,'productList'=>$productList,'subcat'=>$subcat,'subsub'=>$subsub]);

    }

    public function updateInfo(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|unique:users,email,'.auth()->user()->id,
        ]);
       $user = User::find(auth()->user()->id);
       $user->update([
           'name'        => $request->name,
           'email'       => $request->email,
           'mobile'      => $request->mobile,
           'news_letter' => $request->news_letter ? true : false,
       ]);
       Contact::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'mobile'    => $request->mobile,
                'address'   => $request->address,
                'city'      => $request->city,
                'post_code' => $request->post_code,
                'district'  => $request->district,
            ]

        );
       return redirect('/user-details');
    }

    public  function updatePassword(Request $request) {
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'repeat_password'  => 'required|same:new_password',
        ]);
        $current_password = Auth::User()->password;
        if(Hash::check($request['old_password'], $current_password))
        {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request['new_password']);;
            $obj_user->save();
            return redirect('/user-details/my-information')->with([
                'type'      => 'success',
                'message'   => 'Password Change successfully'
            ]);;
        } else {
            return redirect()->back()->with([
                'type'      => 'error',
                'message'   => 'Current password did not match please try again'
            ]);;
        }

    }

    public function show()
    {
        return view('site.login.user.user');
    }


    public function settings()
    {
        $districts = $this->getDistricts();
        return view('site.login.user.partial.editSetting', [
            'districts' => $districts
        ]);
    }
    public function referral()
    {
        $referCount = User::whereReferralId(auth()->user()->id)->count();
        return view('site.login.user.partial.refferal', ['referCount' => $referCount]);
    }
    public function referralFriend()
    {
        return view('site.login.user.partial.refferal-email-send');
    }
    public function referralSendEmail(Request $request)
    {
        $emailData = [
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id
        ];
        $this->sendEmail('email.email-referral', $emailData,auth()->user()->name.' sent invitation to join with us',  $request->input('email'));
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Invitation sent successfully'
        ]);
    }
    public function changePassword()
    {
        return view('site.login.user.partial.change-password');
    }
    public function allOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.all-order', [
            'orders' => $orders
        ]);
    }
    public function shipmentOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->whereOrderStatus('Shipped')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.shipment-order', [
            'orders' => $orders
        ]);
    }
    public function completedOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->whereOrderStatus('Delivered')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.completed-order', [
            'orders' => $orders
        ]);
    }
    public function cancelOrder()
    {
        $orders = Sales::with('items')->whereUserId(auth()->user()->id)
            ->whereOrderStatus('cancel')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('site.login.user.partial.cancel-order', [
            'orders' => $orders
        ]);
    }

    public function creditBuyingHistory()
    {
        $creditHistory = Payment::wherePaymentableType('App\Package')
            ->whereUserId(auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(20);
        return view('site.login.user.partial.credit-buying-history',['creditHistory' => $creditHistory]);
    }

    public function orderCancel($order_no) {
        $sales = Sales::whereOrderNo($order_no)->get();
        if($checkAccessResutl =  $this->checkAccessOfUser($sales[0]->user_id, $sales[0]->order_status)) return $checkAccessResutl;
        foreach ($sales as $sale) {
            $sale->update(['order_status' => 'cancel']);
        }
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Your order canceled successfully.'
        ]);

    }

    public function checkAccessOfUser($userId , $status) {

        if($userId != auth()->user()->id) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not valid person to do that'
            ]);
        }
        if ($status != 'pending') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Only cash on delivery and pending status can cancelable'
            ]);
        }

    }
}
