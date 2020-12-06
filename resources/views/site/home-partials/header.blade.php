<section class="site-header">
    @if(!auth()->user())
     <div class="others">
        <div class="brand">
            <a href="/">
                <img class='img-fluid' src="/images/home/khaasfood.png" alt="logo" style="max-width: 80%;">
            </a>
            <div id="loginBtn" onclick="callMobileLogin();">Login</div>
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
                            <div class="counter">{{Cart::content()->count()}}</div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endif


</section>

<script>
    function callMobileLogin(){
        document.getElementById('mdBlock').classList.toggle('open');

    }
</script>






