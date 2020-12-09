<section class="productPopular" id="popularProduct">
    <div class="col-md-12">
        <h1 class="section-title">
           POPULAR PRODUCT
        </h1>
    </div>
    <div class="col-md-12 ">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($popular as $lat)
                    <div class="swiper-slide">
                        <div class="product">
                            <div class="photo">
                                <a class="details" href="{{url('product/details/'.$lat->id).'/'.$lat->name}}">
                                    <img src="{{asset("images/products/$lat->product_image")}}" alt=""> </a>
                            </div>
                            <div class="base">
                                <p class="title">{{$lat->name}}</p>
                                <div class="inner">
                                    <div class="weight">{{$lat->meta_tag}}</div>
                                    <div class="price">{{$lat->price}} TK</div>
                                </div>
                                <div class="addCart">
                                    <a class="details" href="{{url('product/details/'.$lat->id).'/'.$lat->name}}">Details</a>
                                    {{--<form method="post" action="{{url('/add-to-cart')}}">--}}
                                        {{--@csrf--}}

                                        {{--<input type="hidden" name="qty" min="1" value="1">--}}
                                        {{--<input type="hidden" name="id" value="{{$lat->id}}">--}}
                                        {{--<button class="basket"><i class="fa fa-plus"> </i> basket</button>--}}
                                    {{--</form>--}}
                                    <input type="hidden" name="qty" id="qty" min="1" value="1">
                                    <button class="basket"  onclick="submit({{$lat->id}})"><i class="fa fa-plus"> </i> basket</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Add Pagination -->

        </div>
    </div>
</section>