@extends('site.app')
@section('title-meta')
    <title>Check order status</title>
@endsection

@section('content')

    @include('.site.home-partials.header')

    @include('.site.home-partials.nav-bar')
    <div class="container bg-white aboutUS">
        <form action="{{url('check-order/status')}}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-12 py-4  mt-5 d-flex border">
                    <input type="number"
                           name="orderno"
                           class="form-control"
                           placeholder="Please input order-no"
                    >
                    <button class="btn btn-success mx-2">Search </button>
                </div>

            </div>

        </form>
        </div>

        @if($order !="ahem" || $totalPrice !="ahem" )

        <div class=" mt-5 row p-4 border mb-5">
            <div class="col-md-12 p-0">
                <h4 > Order Status</h4>
                <table class="table-striped table text-capitalize">
                    <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Name</th>
                        <th>Payment Type</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                    @if($order!=null)
                        <tr>
                            <td>#{{$order[0]->order_no}}</td>
                            <td>{{$order[0]->name}}</td>
                            <td>{{$order[0]->payment_type}}</td>
                            <td>{{$totalPrice}} TK</td>
                            <td> {{$order[0]->order_status}}</td>

                        </tr>
                    @else
                        <tr>
                            <td colspan="4"> No order found.</td>
                        </tr>
                        @endif


                    </tbody>
                </table>


            </div>
        </div>


    @endif




@endsection



@section('scripts')
@endsection