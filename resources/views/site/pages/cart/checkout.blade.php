@extends('site.app')
@section('title-meta')
    <title>checkout </title>
@endsection

@section('content')

    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @else
        @include('site.home-partials.header')
    @endif
    @include('site.home-partials.nav-bar')
    <section class="breadCrumb checkout">
        <h1>checkout</h1>
    </section>
    <section class="py-5 checkoutArea">
        <div class="container bg-white p-4" style="border-top: 5px solid #b1b12b;">
            <form method="post" action="{{url('/make-payment')}}">
                @csrf
                <div class="row py-2 header">
                    <div class="col-md-4">
                        <br>
                        <h6 class="checkTitle">Delivery Information </h6>
                        <hr>
                        <div class="deliverInfo">
                            <div class="form-group">
                                <label for="">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="" name="name" required="required"
                                       value= "@if(auth()->user()){{ old('name', $user->name) }}@endif"
                                       placeholder="Enter your full name " class="form-control">

                                <input type="hidden" value="{{request()->get('pcode')}}" name="package_code">
                            </div>
                            <div class="form-group">
                                <label for="">Mobile No <span class="text-danger">*</span></label>
                                <input type="number" name="mobile" required="required"
                                       value= "@if(auth()->user()){{ old('mobile', $user->contact ? $user->contact->mobile: '')}}@endif"
                                       placeholder="Mobile No"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address"
                                       value="@if(auth()->user()) {{ old('address', $user->contact ? $user->contact->address: '') }}@endif"
                                       placeholder="For example : House 123, Street 123 "
                                       required="required"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""> District <span class="text-danger">*</span></label>
                                <select name="district" required="required" class="form-control">
                                    @foreach($districts as $district)
                                        <option value="{{$district['name']}}"
                                                @if ( auth()->user() && old('district', $user->contact ? $user->contact->district : '' ) == $district['name'] )
                                                selected
                                                @endif
                                        >{{$district['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""> City <span class="text-danger">*</span></label>
                                <input type="text" name="city"
                                       placeholder="City name"
                                       class="form-control" required>
                            </div>
                            <div class="form-group"><label for=""> Post Code</label>
                                <input type="number" name="post_code"
                                       value="@if(auth()->user()) {{ old('post_code', $user->contact ? $user->contact->post_code : '') }}@endif"
                                       placeholder="Post Code"
                                       class="form-control" required></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <h6 class="checkTitle">Select a payment method </h6>
                        <hr>
                        <ul class="payments">
                            <li>
                                <label class="payment-items">
                                    <img src="/images/bkash.png" class="img-fluid">
                                    <p>Payment By Bkash</p>
                                    <input
                                            type="radio" name="payment_method" value="ssl" required="required"
                                            @if ( auth()->user() && old('payment_method')=='ssl')
                                            checked
                                            @endif>
                                </label>
                            </li>
                            <li>
                                <label class="payment-items">
                                    <img src="/images/master-card.png" class="img-fluid">
                                    <p>Cash On Deliver</p>
                                    <input type="radio" name="payment_method"
                                           value="cash_on_delivery"
                                           @if ( auth()->user() && old('payment_method')=='cash_on_delivery')
                                           checked
                                            @endif>

                                </label>
                            </li>
                        </ul>
                        <center>
                            <img align="center" src="/images/home/cash-on-delivery.svg" width="150px" class="mt-5">
                        </center>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <div class="basket">
                            <p class="title">Your Items</p>
                            <div class="confirmCart">
                                <div class="productList">
                                    @php
                                        $count=1;
                                        $subTotal=0;
                                    @endphp
                                    <p class="font-weight-bold"><span>Product</span>
                                        <span>Quantity</span> <span>Total</span>
                                    </p>
                                    @foreach($cartItems as $item)
                                    <p>
                                        <span>{{$count}}. {{$item->name}}</span>
                                            <span>{{$item->qty}}</span>
                                            <span>{{$item->price}}</span>
                                    </p>
                                    @php
                                        $count++;
                                         $subTotal+=$item->price*$item->qty;
                                    @endphp
                                    @endforeach
                                </div>
                                <div class="fix">
                                    <p><span> <b>Sub total</b> </span><span>{{$setting->amount_sign}}{{$subTotal}}</span></p>
                                    <p><span>(+) Delivery cost </span> <span>{{$setting->amount_sign}}{{$shippingCost?$shippingCost->amount:0}}</span></p>
                                    <p> @if($promotion)

                                            <span>(-) Discount {{$promotion->sign=='Percentage'?'('.$promotion->amount.'%)':''}}</span>
                                            @if($promotion->sign=='Percentage')
                                                @php
                                                    $discountAmount=($subTotal*
                                                $promotion->amount)/100
                                                @endphp
                                                <span>{{$setting->amount_sign}}{{$discountAmount}}</span>
                                            @else
                                                @php
                                                    $discountAmount=$promotion->amount
                                                @endphp
                                                <span>{{$setting->amount_sign}}{{$promotion->amount}}</span>
                                            @endif

                                        @else
                                            @php
                                                $discountAmount=0
                                            @endphp
                                            <span>(-) Discount</span>
                                            <span>{{$setting->amount_sign}}0</span>
                                        @endif
                                    </p>
                                    <p class="mt-2 font-weight-bold"><span>Grand Total </span>
                                        <span>{{$setting->amount_sign}}
                                            {{($subTotal+($shippingCost?$shippingCost->amount:0)-$discountAmount)}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="buttonSection">
                            <a href="{{url('/all-products')}}" class="confirmPay shopping" style="color: black; text-decoration: none;">
                                Continue Shopping!</a>
                            <button type="submit" class="confirmPay">Confirm Order!</button>
                        </div>

                        <p class="ddate mt-5">
                            Delivery Date : <br>
                            <select class="js-example-basic-multiple form-control"
                                    name="delivery_date"  id="select1" required>
                                <option value="">Select Delivery Date</option>
                                @foreach($delivery as $key=>$dd)
                                    <option value="{{$dd->deilivary_date}}">
                                        {{date('l, jS  F, Y', strtotime($dd->deilivary_date)) }}</option>
                                @endforeach
                            </select>

                            {{--<input type="date" class="form-control" name="" id="" class="mt-2">--}}
                        </p>

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection