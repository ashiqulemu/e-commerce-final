<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-title">
                    PRODUCT CATEGORIES
                </h1>
            </div>
            <?php $i = 0;?>
            @foreach($category as $cat)
                <div class="col-md-4">
                    <div class="cat">
                        <a class="d-block" href="{{url('/all-products')}}">
                            <img style=" width: 100%; height: auto;object-fit: cover;" src="{{URL::to('/')}}/images/{{$category[$i]->category_image}}" alt=""/>

                        <div class="nameBar">{{$category[$i]->name}}</div>
                        </a>
                    </div>
                </div>
                <?php $i++; ?>
            @endforeach

        </div>
    </div>
</section>