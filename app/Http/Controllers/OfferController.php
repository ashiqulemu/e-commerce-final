<?php

namespace App\Http\Controllers;

use App\offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.pages.offer.create');
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
            'name'=>'required',
            'status'=>'required',
            'offer_image'=>'required',

        ]);

        $offer=new offer();
        $offer->name=$request->name;
        $offer->description=$request->description;
        $offer->day_start=$request->day_start;
        $offer->day_end=$request->day_end;
        if ($request->hasfile('offer_image')) {
            $image = $request->file('offer_image');
            $filename = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/offer/'), $filename);
            $offer->offer_image = $filename;
        }
        $offer->status=$request->status;
        $offer->save();
        return redirect('/admin/offer/create')
            ->with(['type'=>'success','message'=>'Category created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer $offer)
    {
        //
    }
}
