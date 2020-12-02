@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <!-- /.row -->
        <div class="row reportPanels" style="padding-top: 30px">
            <div class="col-lg-3 col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="text-warning fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">@if($totalOrders){{$totalOrders}}@endif</div>
                                <div>Total Orders</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/admin/sales')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="text-warning fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">@if($totalTodayOrders){{$totalTodayOrders}}@endif</div>
                                <div>Today Orders</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/admin/sales')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="text-warning fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$totalPendingOrders}}</div>
                                <div>Pending Order</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/admin/latest')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="text-warning fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">@if($totalProduct){{$totalProduct}}@endif</div>
                                <div>Stock</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/admin/product-report')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">

        </div>

    </div>
@endsection