<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#callNav"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <span class="customToggleCategories" onclick="allProducts();">all categories</span>



    <div class="collapse navbar-collapse" id="callNav">

        <ul class="navbar-nav custom mr-auto">

            <li class="nav-item d-flex ">
                <input type="search"
                       name=""
                       onkeyup="setSearchLink()"
                       onchange="setSearchLink()"
                       id="searchProduct"
                       class="productSearch form-control"
                       value="{{request()->input('search')}}"
                       placeholder="What are you looking for ..."
                >
                <a href="/all-products"
                   id="searchLink"
                   class="btn  btn-success ml-2"
                >Search </a>
            </li>
        </ul>
        <ul class="navbar-nav custom ml-auto">
            @if(auth()->user())
            <li class="nav-item">
                <a class="nav-link active" href="{{url('/user-home')}}">Home </a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('/')}}">Home </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link " href="{{url('/all-products')}}">All product </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('/popular-products')}}">Popular Product </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('/latest-products')}}">Latest Product </a>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link " href="#">Offer </a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{url('/products')}}">Products</a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{url('/about')}}">About Us</a>
            </li>


            <li class="nav-item">
                <a class="nav-link"  href="{{url('/contact')}}">Contact Us</a>
            </li>
            @if(!auth()->user())
            <li class="nav-item">
                <a class="nav-link"  href="" data-toggle="modal" data-target="#myModal">Agent</a>
            </li>
            @endif
            @if(!auth()->user())
            <li class="nav-item">
                <a class="nav-link"  href="{{url('/check-order')}}">Check Order Status</a>
            </li>
            @endif
        </ul>


    </div>

</nav>


<script>
    function allProducts(){
        document.getElementById("sidebar").classList.toggle('open');
        document.getElementById("mobileBox").style.display='block';
    }
</script>

