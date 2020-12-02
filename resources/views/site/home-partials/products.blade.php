@extends('site.app')

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @else
        @include('site.home-partials.header')
    @endif
    @include('site.home-partials.nav-bar')
    <div class="allProducts">
        @include('site.home-partials.sidebar')
        <div class="productContainer">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="{{asset('/images/others/544225b2cc058_thumb900.jpg')}}" alt="">
                </div>
            </div>
            <hr>
            <div class="row mt-5 mobile">
                @foreach($productList as $product)
                    <div class="col d-flex">
                        <div class="product">
                            <div class="photo">
                                <a href="{{url('product/details/'.$product->id).'/'.$product->name}}"><img src="{{asset("images/products/$product->product_image")}}" alt=""/></a>
                            </div>
                            <div class="base">
                                <p class="title">{{$product->name}}</p>
                                <div class="inner">
                                    <div class="weight">{{$product->meta_tag}}</div>
                                    <div class="price">@if(auth()->user() && auth()->user()->role=="agent"){{$product->agent_price}} @else{{$product->price}}@endif TK</div>
                                </div>
                                <div class="addCart">
                                    <a class="details" href="{{url('product/details/'.$product->id).'/'.$product->name}}">Details</a>
                                    <form method="post" action="{{url('/add-to-cart')}}">
                                        @csrf

                                        <input type="hidden" name="qty" min="1" value="1">
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <button class="basket"><i class="fa fa-plus"> </i> basket</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <script>
        function setSearchLink() {
            var val = $('#searchProduct').val()
            $('#searchLink').attr('href', '/all-products?search=' + val)
        }



    </script>
@endsection