@extends('site.app')
@section('title-meta')
    <title>Home</title>
@endsection

@section('content')
    <div class="control_menu">
        @if(auth()->user())
            @include('site.login.login-partitial.header')
        @else
            @include('site.home-partials.header')
        @endif
        @include('site.home-partials.nav-bar')
    </div>
    @include('site.home-partials.banner')
    @include('site.home-partials.advertisement')
    @include('site.home-partials.productNewArrival')
    @include('site.home-partials.productPopular')
    @include('site.home-partials.promise')
    @include('site.home-partials.categories')
    @include('site.home-partials.reviews')
    @include('site.home-partials.howOrder')

@endsection



@section('scripts')

@endsection