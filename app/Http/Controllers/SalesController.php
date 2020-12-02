<?php

namespace App\Http\Controllers;

use App\SaleItem;
use App\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::all();
        return view('admin.pages.sales.manage', ['sales' => $sales]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Sales $sales)
    {
        //
    }
    public function updateOrderStatus (Request $request, $orderId, $status) {
        $sale = Sales::find($orderId);
        $sale->update(['order_status' => $status]);
        return back()->with([
            'type'     => 'success',
            'message' => 'Order status updated successfully'
        ]);
    }
    public function neworder()
    {

        $sales = Sales::all();

        return view('admin.pages.sales.new', ['sales' => $sales]);
    }
    public function order()
    {
        $order="ahem";
        $totalPrice="ahem";
        return view('site.pages.partials.check-order', ['order' => $order,'totalPrice' => $totalPrice]);
    }
    public function orderstatus(Request $request)
    {

        $orderno=(int)$request->orderno;
        $order=DB::table('sales')
            ->select('*')
            ->where('order_no','=',$orderno)
            ->get();

        if(sizeof($order)==0)
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not authorized to access that information'
            ]);
        if($order[0]->user_id !=null)
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not authorized to access that information'
            ]);
        $price=DB::table('sale_items')
            ->select('total_price')
            ->where('sales_id','=',$order[0]->id)
            ->get();
      $totalPrice=$price[0]->total_price;

        return view('site.pages.partials.check-order', ['order' => $order,'totalPrice'=>$totalPrice]);

    }

}
