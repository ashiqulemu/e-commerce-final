

<div class="sidebar" id="sidebar">
    <div class="mobileBox" id="mobileBox" @click.prevent="$root.closeSidebar"> </div>
        <p class="categoriesTitle">All Categories</p>
    <ul class="menuItems">
        @foreach($categories as $category)
            <li class="list">
                @if($category->cat_order =="only")
                    <a  href="{{url('category-pro/'.$category->id)}}" >
                        {{$category->name}}

                    </a>
                @else
                    <a  class="multilevel" onClick="dropdown(event)" onmouseover="dropdown(event)">
                        {{$category->name}}

                        <i class="fa fa-caret-right aero"></i>
                    </a>
                @endif

                <ul class="subItems">
                    @foreach($subcat as $subc)
                        @if( $subc->category_id == $category->id)
                            <li>
                                @if($category->cat_order =="sub-category")
                                    <a href="{{url('subcat-pro/'.$subc->id)}}"> {{$subc->name}}</a>
                                @else
                                    <a  class="multilevel" onClick="dropdown(event)" onmouseover="dropdown(event)"> {{$subc->name}}</a>
                                @endif
                                <ul class="subItems">
                                    @foreach($subsub as $sub)
                                        @if( $sub->subcat_id == $subc->id)
                                            <li>
                                                @if($category->cat_order =="sub_sub_category")
                                                    <a href="{{url('subsub-pro/'.$sub->id)}}">{{$sub->name}} </a>
                                                @else
                                                    <a href="#">{{$sub->name}} </a>
                                                @endif

                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                                @endforeach
                            </li>
                </ul>


            </li>
        @endforeach
    </ul>

</div>
<script>
    function dropdown(event) {
        event.target.nextElementSibling.classList.toggle('active');
        event.target.children[0].classList.toggle('active');
    }
</script>