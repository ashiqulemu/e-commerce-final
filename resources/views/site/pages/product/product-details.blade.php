@extends('site.app')
@section('title-meta')
    <title>Product Details</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.login-partitial.header')
    @else
        @include('site.home-partials.header')
    @endif
    <section class="detailsProduct">
        <div class="">
            @include('site.home-partials.nav-bar')
            <div class="d-flex flex-wrap bg-white">
                <div class="col-lg-3 bg-white p-0 pr-2">
                    @include('site.home-partials.sidebar')
                </div>
                <div class="col-md-9 row pt-5">
                    <div class="col-lg-4 bg-white  mt-2">
                        <div class="photo">
                            <img src="{{asset("images/products/$item->product_image")}}" alt="" height="auto"
                                 width="300px"/>
                        </div>
                        {{--                            <div class="sp-wrap mt-3">]--}}
                        {{--                                @foreach($item->medias as $key=>$media)--}}
                        {{--                                    <a href="{{asset("storage/$media->image")}}">--}}
                        {{--                                        <img src="{{asset("storage/$media->image")}}"--}}
                        {{--                                             alt=""></a>--}}

                        {{--                                @endforeach--}}

                        {{--                            </div>--}}


                    </div>
                    <div class="col-lg-4 bg-white mt-2">
                        <div class="product-varient ">
                            <div class="product-title">Name: {{$item->name}}</div>

                            <div class="product-price">Price:
                                <span>@if(auth()->user() && auth()->user()->role=="agent"){{$item->agent_price}} @else{{$item->price}}@endif
                                    TK</span>
                            </div>
                            <form method="post" action="{{url('/add-to-cart')}}">
                                @csrf
                                <div class="product-quantity">
                                    <span>quantity:</span>
                                    <input type="text" name="qty" min="1" value="1">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                </div>
                                <button type="submit" class="btn-theme mt-2">add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 bg-white  mt-2">
                        <div class="your-basket  mt-3">
                            <header>
                                your basket
                            </header>
                            <article>
                                <div class="max-input">
                                    <table class="product-list">
                                        @php
                                            $count=1;
                                            $subTotal=0;
                                        @endphp
                                        @foreach($cartItems as $item)

                                            <tr>

                                                <td>{{$count}}. {{$item->name}}</td>
                                                <td>
                                                    <input type="number"
                                                           min="1"
                                                           onchange="setCartUpdateUrl({{$item->id.",'".$item->rowId."'"}})"
                                                           onkeyup="setCartUpdateUrl({{$item->id.",'".$item->rowId."'"}})"
                                                           id="cartQuantity{{$item->id}}"
                                                           disabled
                                                           value="{{$item->qty}}"
                                                           style="width: 40px">

                                                </td>
                                                <td>{{$setting->amount_sign}}{{$item->price}}</td>
                                                <td>{{$setting->amount_sign}}{{$item->price*$item->qty}}</td>
                                                <td>
                                                    <i class="fa fa-edit"
                                                       title="Edit"
                                                       onclick="editCartItem({{$item->id.",'".$item->rowId."'"}})"
                                                       id="cartEditBtn{{$item->id}}">

                                                    </i>
                                                    <a href="#" id="cartUpdateUrl{{$item->id}}">
                                                        <i class="fa fa-check"
                                                           title="Update"
                                                           id="cartUpdateBtn{{$item->id}}"
                                                           style="display: none">

                                                        </i>
                                                    </a>
                                                    <a href="{{url('/delete/cart-item/'.$item->rowId)}}">
                                                        <i class="fa fa-trash text-danger" title="Delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $count++;


                                                  $subTotal+=$item->price*$item->qty;



                                            @endphp
                                        @endforeach
                                    </table>
                                </div>

                                <table class="additional-list">
                                    <tr>
                                        <td>
                                            Promo Code
                                        </td>
                                        <td>
                                            <div class="promoSection">
                                                <input type="text"
                                                       onchange="setPromoLink({{$item->id.",'".$item->name."'"}})"
                                                       onkeyup="setPromoLink({{$item->id.",'".$item->name."'"}})"
                                                       class="promo"
                                                       required
                                                       id="promoInput"
                                                >
                                                <a href="#" id="promoLink"
                                                   class="btn btn-sm btn-warning use-btn"
                                                >use</a>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Sub total</td>
                                        <td>{{$setting->amount_sign}}{{$subTotal}}</td>
                                    </tr>
                                    @if(count($cartItems))
                                        <tr>
                                            <td>(+) Delivery cost</td>
                                            @if($shippingCost)
                                                <td>{{$setting->amount_sign}}{{$shippingCost->amount}}</td>
                                            @else
                                                <td>{{$setting->amount_sign}}0</td>
                                            @endif
                                        </tr>
                                    @else
                                        <tr>
                                            <td>(+) Delivery </td>
                                            <td>{{$setting->amount_sign}}0</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        @if($promotion)

                                            <td>(-) Discount {{$promotion->sign=='Percentage'?
                                        '('.$promotion->amount.'%)':''}}</td>
                                            @if($promotion->sign=='Percentage')
                                                @php
                                                    $discountAmount=($subTotal*
                                                $promotion->amount)/100
                                                @endphp
                                                <td>{{$setting->amount_sign}}{{$discountAmount}}</td>
                                            @else
                                                @php
                                                    $discountAmount=$promotion->amount
                                                @endphp
                                                <td>{{$setting->amount_sign}}{{$promotion->amount}}</td>
                                            @endif

                                        @else
                                            @php
                                                $discountAmount=0
                                            @endphp
                                            <td>(-) Discount</td>
                                            <td>{{$setting->amount_sign}}0</td>
                                        @endif

                                    </tr>
                                    @if(count($cartItems))
                                        <tr>
                                            <td>Grand total</td>
                                            @if($shippingCost)
                                                @if($promotion)
                                                    <td>
                                                        {{$setting->amount_sign}}{{($subTotal+$shippingCost->amount)
                                                    -$discountAmount}}</td>
                                                @else
                                                    <td>{{$setting->amount_sign}}{{$subTotal+$shippingCost->amount}}</td>
                                                @endif

                                            @else
                                                <td>{{$setting->amount_sign}}{{$subTotal}}</td>
                                            @endif
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Grand total</td>
                                            <td>{{$setting->amount_sign}}{{$subTotal}}</td>
                                        </tr>
                                    @endif
                                </table>

                            </article>

                            <footer>

                                <a href="{{url('/payment-confirmation')}}"
                                   class="checkout"
                                   style="margin-bottom: 5px;
                                   text-decoration: none">go to checkout</a>


                                {{--@if(request()->input('pcode'))--}}
                                {{--<a href="{{url('/pay
                                ment-confirmation?pcode='.request()->--}}
                                {{--input('pcode'))}}"--}}
                                {{--class="checkout"--}}
                                {{--style="margin-bottom: 5px;--}}
                                {{--text-decoration: none">go to checkout</a>--}}
                                {{--@else--}}
                                {{--<a href="{{url('/payment-confirmation')}}"--}}
                                {{--class="checkout"--}}
                                {{--style="margin-bottom: 5px;--}}
                                {{--text-decoration: none">go to checkout</a>--}}
                                {{--@endif--}}

                                <a href="{{url('/all-products')}}"
                                   class="checkout shopping" style="text-decoration: none">Continue
                                    Shopping!</a>


                            </footer>
                        </div>
                        @if(!auth()->user())
                            <div class="notice">
                                <p>You are currently in Guest user mode. Please Login for better buying experience.</p>
                                <div>
                                    <a href="#" class="btn btn-sm btn-success">Login</a>
                                    <a href="{{ url('auth/facebook') }}" class="btn  btn-sm btn-primary"><span>Login with </span>
                                        <i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class=" p-0 col-md-12">
                        <div class="product_details">
                            <div class="productDescription p-3">
                                <br>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#">Description</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active pt-3 pb-3">
                                        {!! $item->description !!}
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 mb-5">
                        <h2>Related Product </h2>
                        <hr>
                        <div class="swiper-container">
                            <div class="swiper-wrapper" style="height: auto">

                                @foreach($related as $rel)
                                    <div class="swiper-slide">
                                        <div class="product">
                                            <div class="photo">
                                               <a href="{{url('product/details/'.$rel->id).'/'.$rel->name}}"> <img src="{{asset("images/products/$rel->product_image")}}" alt=""></a>
                                            </div>
                                            <div class="base">
                                                <p class="title">{{$rel->name}}</p>
                                                <div class="inner">
                                                    <div class="weight">{{$rel->meta_tag}}</div>
                                                    <div class="price">@if(auth()->user() && auth()->user()->role=="agent"){{$rel->agent_price}} @else{{$rel->price}}@endif
                                                        TK
                                                    </div>
                                                </div>
                                                <div class="addCart">
                                                    <a class="details"
                                                       href="{{url('product/details/'.$rel->id).'/'.$rel->name}}">Details</a>
                                                    <form method="post" action="{{url('/add-to-cart')}}">
                                                        @csrf

                                                        <input type="hidden" name="qty" min="1" value="1">
                                                        <input type="hidden" name="id" value="{{$rel->id}}">
                                                        <button class="basket"><i class="fa fa-plus"> </i> basket
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            {{--<!-- Add Pagination -->--}}

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection


@section('scripts')
    <script>
        function setPromoLink(id, name) {
            var val = $('#promoInput').val()
            $('#promoLink').attr('href', '/product/details/' + id + '/' + name + '?pcode=' + val)
        }

    </script>
@endsection

<style lang="scss">

</style>

