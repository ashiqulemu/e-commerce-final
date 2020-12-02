@extends('site.app')
@section('title-meta')
    <title>Firebidder user loged </title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @else
        @include('site.home-partials.header')
    @endif
    @include('site.home-partials.nav-bar')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My info</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.components.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">
                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">My discount</h4>

                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

@endsection
