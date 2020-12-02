
    <div class="productContainer">
        <div class="row">
            <div class="col">
                <img class="img-fluid" src="{{asset('/images/others/544225b2cc058_thumb900.jpg')}}" alt="">
            </div>
        </div>
        <hr>
        <div class="row mt-5">
            @foreach($productList as $product)
                <div class="col">
                    <div class="product">
                        <div class="photo">
                            <img src="{{asset("images/products/$product->product_image")}}" alt=""/>
                        </div>
                        <div class="base">
                            <p class="title">Green Guava</p>
                            <div class="inner">
                                <div class="weight">500mg</div>
                                <div class="price">10 Tk</div>
                            </div>
                            <div class="addCart">
                                <button class="details" >Details</button>
                                <button class="basket"><i class="fa fa-plus"> </i> basket</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


