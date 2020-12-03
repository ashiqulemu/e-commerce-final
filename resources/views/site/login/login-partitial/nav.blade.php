
<section class="">
    <nav class="navbar navbar-expand-lg navbar-dark " id="navUser">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#callNav"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="callNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item  ">
                    <a class="nav-link active" href="/">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/products')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/about')}}">About Us</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link"  href="{{url('/contact')}}">Contact Us</a>
                </li>

            </ul>
        </div>
        {{--<search-component></search-component>--}}
    </nav>
</section>