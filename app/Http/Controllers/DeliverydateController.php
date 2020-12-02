<?php

namespace App\Http\Controllers;

use App\deliverydate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliverydateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $delivery=DB::table('deliverydates')
                ->select('*')
                ->orderBy('created_at','desc')
                ->get();

       return view('admin.pages.delivery_date.manage',['delivery'=>$delivery]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view("admin.pages.delivery_date.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'delivery_date'=>'required',
            'quantity'=>'required'
        ]);

        $delivery=new deliverydate();
        $delivery->deilivary_date=$request->delivery_date;
        $delivery->quantity=$request->quantity;
        $delivery->save();
        return redirect('/admin/delivery/create')
            ->with(['type'=>'success','message'=>'delivery created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\deliverydate  $deliverydate
     * @return \Illuminate\Http\Response
     */
    public function show(deliverydate $deliverydate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\deliverydate  $deliverydate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery= deliverydate::find($id);
        return view("admin.pages.delivery_date.edit",['delivery'=>$delivery]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\deliverydate  $deliverydate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $delivery= deliverydate::find($id);
        $delivery->deilivary_date=$request->delivery_date;
        $delivery->quantity=$request->quantity;
        $delivery->save();
        return redirect('/admin/delivery')
            ->with(['type'=>'success','message'=>'Delivery Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\deliverydate  $deliverydate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery= deliverydate::find($id);
        $delivery->delete();
        return back()
            ->with(['type'=>'success','message'=>'Delivery deleted successfully']);
    }
}
