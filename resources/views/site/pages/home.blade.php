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
    <script>

        function submit(id){
            console.log(id);
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
                    console.log(data);
                    $("#counter").empty();
                    $message=data;
                    $("#counter").append($message);


                }
            })

        }

    </script>

@endsection