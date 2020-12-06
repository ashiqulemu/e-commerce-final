<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i> Agent <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{url('/admin/agent/create')}}">Add Agent</a>
                                        </li>
                    <li>
                        <a href="{{url('/admin/agent')}}">Manage Agent</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/newAgent')}}">New Agent Activate</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-cubes"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/category/create')}}"> Add Category</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/category')}}"> Manage Category</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-cubes"></i> Subcategory<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/subcategory/create')}}"> Add Subategory</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/subcategory')}}"> Manage Subategory</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-cubes"></i> Subsubcategory<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/subsub/create')}}"> Add Subsubategory</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/subsub')}}"> Manage Subsubategory</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-cubes"></i> Offer Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/offer/create')}}"> Add Offer</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/offer')}}"> Manage Offer</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-gift"></i> Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/product/create')}}">Add Product</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/product')}}">Manage Product</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sale<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
{{--                    <li>--}}
{{--                        <a href="blank.html">Add Sale</a>--}}
{{--                    </li>--}}
                    <li>
                        <a href="{{url('/admin/sales')}}">Manage Sale</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/latest')}}">New order</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i> Customer<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/customer/create')}}">Add Customer</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/customer')}}">Manage Customer</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-money"></i> Shipping Cost<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/shipping-cost/create')}}">Add Shipping Cost</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/shipping-cost')}}">Manage Shipping Cost</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bullhorn"></i> Promotion<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/promotion/create')}}">Add Promotion</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/promotion')}}">Manage Promotion</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            {{--<li>--}}
                {{--<a href="#"><i class="fa fa-list-alt"></i> Package<span class="fa arrow"></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                        {{--<a href="{{url('/admin/package/create')}}">Add Package</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{url('/admin/package')}}">Manage Package</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- /.nav-second-level -->--}}
            {{--</li>--}}
            <li>
                <a href="#"><i class="fa fa-certificate"></i> CMS<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/cms/create')}}">Add CMS</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/cms')}}">Manage CMS</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-money"></i> Delivery Date<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/delivery/create')}}">Add Delivery Date</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/delivery')}}">Manage Delivery date</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
{{--            <li>--}}
{{--                <a href="#"><i class="fa fa-pie-chart"></i> Report<span class="fa arrow"></span></a>--}}
{{--                <ul class="nav nav-second-level">--}}
{{--                    <li>--}}
{{--                        <a href="blank.html">Product Report</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="login.html">Sale Report</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <!-- /.nav-second-level -->--}}
{{--            </li>--}}

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->

