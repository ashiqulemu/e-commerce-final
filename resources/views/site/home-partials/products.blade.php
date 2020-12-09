@extends('site.app')

@section('content')
    <div class="control_menu">
        @if(auth()->user())
            <section class="loged-header">
                <div class="container">
                    <div class="header">
                        <div>
                            <div class=" text-center">
                                <a href="{{url('/user-home')}}"><img src="/images/home/khaasfood.png" class="img-fluid" style="width:200px"></a>
                            </div>
                        </div>
                        <div>
                            <ul>
                                {{--<li><a href="/how-it-works">How it works</a></li>--}}
                                <li>
                                    <i class="fa fa-user"></i>
                                    <a href="{{url('/user-details')}}">{{auth()->user()->username}}</a>
                                </li>
                                <li>
                                    <a href="{{url('/view-cart')}}" title="view shopping cart" class="shoppingCart">
                                        <i class="fa fa-cart-plus" style="font-size: 34px">

                                        </i>
                                        <div class="counter" id="counter">{{Cart::count()}}</div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        @if(auth()->user())
                            <div>
                                <a class="btn btn-danger" href="{{ url('admin/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <style>
                .shoppingCart .counter{
                    top: -19px!important;
                }
            </style>
        @else
            <section class="site-header">
                @if(!auth()->user())
                    <div class="others">
                        <div class="brand">
                            <a href="/">
                                <img class='img-fluid' src="/images/home/khaasfood.png" alt="logo" style="max-width: 80%;">
                            </a>
                        </div>

                        <div class="authPanel">
                            <div class="loged_area" id="mdBlock">

                                @if(!($uri === 'forget-password' || strpos($uri, 'password/reset')))
                                    <form method="POST" action="{{ url('/admin/login') }}" class="form-inline">
                                        @csrf
                                        <div class="authPanel" id="login-area">
                                            <div class="titleBar"> <article>Already a customer ?</article> </div>
                                            <div class="loged_area">
                                                <div>
                                                    <input id="login"
                                                           type="text"
                                                           class="form-control{{ $errors->has('username') ||
                                               $errors->has('email') ? ' is-invalid' : '' }}"
                                                           placeholder="Username or email"
                                                           name="login" value="{{ old('username') ?: old('email')
                                                }}" required autofocus>
                                                    @if ($errors->has('username') || $errors->has('email'))
                                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') ?:
                                    $errors->first('email') }}</strong>
                                            </span>
                                                    @endif


                                                </div>
                                                <div>

                                                    <input id="password"
                                                           type="password"
                                                           class="form-control @error('password') is-invalid
                                               @enderror"
                                                           name="password"
                                                           required
                                                           autocomplete="current-password"
                                                           placeholder="Password">

                                                    @error('password')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                    <input type="hidden" name="from" value="st">

                                                </div>
                                                <div>
                                                    <div class="form-group mb-2 flex-column">
                                                        <button type="submit" class="btn  login  ">Login</button>
                                                    </div>
                                                </div>
                                                <div class="links">
                                                    <a href="{{ url('auth/facebook') }}" class="btn  btn-sm"  >
                                                        <span>Login with </span> <i class="fa fa-facebook"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="middle-bottom">
                                                <div>
                                                    Forgot password? <a href="{{url('/forget-password')}}">Click Here</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                @endif
                            </div>

                        </div>

                        <div class="cart">
                            <div class="signup">
                                <div class="titleBar"> <article>New to Adi ?</article> </div>
                                <a href="{{url('/register')}}" class="btn  btn-sm"> <i class="fa fa-user"></i> Sign Up </a>
                            </div>
                            <div class="inner">
                                <div class="social">
                                    <div class="user">
                                        <span> hi Guest</span>
                                    </div>
                                    <div class="mb-3 homeCart mt-3">
                                        <a href="/view-cart" title="view shopping cart" class="shoppingCart">
                                            <i class="fa fa-cart-arrow-down"  ></i>
                                            <div class="counter" id="counter">{{Cart::count()}}</div>
                                            {{--<div class="amount" id="amount"> TK</div>--}}
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endif


            </section>
        @endif
        @include('site.home-partials.nav-bar')
    </div>

    <div class="allProducts">
        @include('site.home-partials.sidebar')
        <div class="productContainer">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="{{asset('/images/others/544225b2cc058_thumb900.jpg')}}" alt="">
                </div>
            </div>
            <hr>
            <span class="customToggleCategories btn btn-sm btn-dark" onclick="allProductsForAll();">all categories</span>
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
                                    {{--<form method="post" action="{{url('/add-to-cart')}}">--}}
                                        {{--@csrf--}}

                                        {{--<input type="hidden" name="qty" min="1" value="1">--}}
                                        {{--<input type="hidden" name="id" value="{{$product->id}}">--}}
                                        {{--<button class="basket"><i class="fa fa-plus"> </i> basket</button>--}}
                                    {{--</form>--}}
                                    <input type="hidden" name="qty" id="qty" min="1" value="1">
                                    <button class="basket"  onclick="submit({{$product->id}})"><i class="fa fa-plus"> </i> basket</button>

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
        function allProductsForAll(){
            document.getElementById("sidebar").classList.toggle('open');
            document.getElementById("mobileBox").style.display='block';
        }

    </script>
    <script>

        function submit(id){
            var token = "{{ csrf_token() }}";
            var qty=$('#qty').val();
            $.ajax({
                url: '/add-cart',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    _token: token,
                    id:id,
                    qty:qty,
                },
                success: function (data)
                {

                    $("#counter").empty();
                    $message=data;
                    $("#counter").append($message);


                }
            })

        }

    </script>

@endsection