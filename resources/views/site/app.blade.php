<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title-meta')
    <meta http-equiv="refresh" content="900"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    @php
        $date = new DateTime(); $serverTime = $date->format('Y-m-d H:i:s');
        $timeZone = $date->getTimezone()->getName();
    @endphp

    <script>
        window.serverTime = "{{ $serverTime }}";
        window.auth = "{{request()->user()}}";
        window.currentPath = "{{request()->path()}}";
        window.allAuctionSetTimout=[];
        window.timeZone="{{$timeZone}}";
    </script>

    <script type="text/javascript">
        // Get rid of the Facebook residue hash in the URI
        // Must be done in JS cuz hash only exists client-side
        // IE and Chrome version of the hack
        if (String(window.location.hash).substring(0,1) == "#") {
            window.location.hash = "";
            window.location.href=window.location.href.slice(0, -1);
        }
        // Firefox version of the hack
        if (String(location.hash).substring(0,1) == "#") {
            location.hash = "";
            location.href=location.href.substring(0,location.href.length-3);
        }
    </script>
</head>
<body>

<div id="app" v-cloak>


    @if(session('message'))
        <div class="flash-message">
            @if(session('type')=='success')
                <div class="alert alert-warning" role="alert" id="successMessage">
                    @else
                        <div class="alert alert-danger " role="alert" id="successMessage">
                            @endif

                            {{--<h4 class="alert-heading w-capitalize">{{session('type')}} !</h4>--}}
                            <p class="w-capitalize">{{session('message')}}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                </div>
        </div>
    @endif


    @yield('content')
    @include('site.home-partials.footer')

</div>

{{--<div class="loader-container" id="preload">--}}
{{--<div class="loader-logo">--}}
{{--<div class="loader-circle"></div>--}}
{{--</div>--}}
{{--</div>--}}

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="phone">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" cols="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Add Agent</button>
                </form>
            </div>
            <div class="modal-footer">  </div>
        </div>
    </div>
</div>


<script src="{{mix('js/app.js')}}"></script>

{{--<script src="{{asset('js/smoothproducts.min.js')}}"></script>--}}


@yield('scripts')


{{--<script src="{{asset('js/zoom-image.js')}}"></script>--}}
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>


</body>
</html>
