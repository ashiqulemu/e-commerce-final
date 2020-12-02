


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
                            <div class="counter">{{Cart::content()->count()}}</div>
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