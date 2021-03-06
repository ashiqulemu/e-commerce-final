@extends('site.app')
@section('title-meta')
    <title>Cancel order </title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')

    @endif
    @include('site.home-partials.nav-bar')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Info</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.components.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">
                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">Cancel Order</h4>
                        <table class="table-striped table text-capitalize">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Total Price</th>
                                <th>Order Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td> <a href="{{'/order-invoice/'.$order->order_no}}">
                                                #{{$order->order_no}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$setting->amount_sign}}
                                            {{($order->total + $order->shipping_cost) - $order->discount}}
                                        </td>
                                        <td> {{$order->order_status}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3"> No order found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

@endsection
