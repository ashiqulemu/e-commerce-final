@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Stock Remain
                </p>
            </div>

            <div class="col-md-12">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $key => $product)
                            @if($product->quantity <= 5)
                            <tr style="color: #ffffff">
                                <td bgcolor="red">{{$key+1}}</td>
                                <td bgcolor="red">{{$product->name}}</td>
                                <td bgcolor="red">{{$product->category->name}}</td>
                                <td bgcolor="red">{{$product->price}}</td>
                                <td bgcolor="red">{{$product->quantity}}</td>
                            </tr>
                            @else
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>
                                </tr>
                                @endif
                        @endforeach

                        </tbody>

                    </table>
                </div>




            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection
