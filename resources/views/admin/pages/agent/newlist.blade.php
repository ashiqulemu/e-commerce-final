@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage agent application
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Username</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agent as $key=>$ag)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$agent[$key]->name}}</td>
                                <td>{{$agent[$key]->email}}</td>
                                <td>{{$agent[$key]->mobile}}</td>
                                <td>{{$agent[$key]->is_active?"Active":"Inactive"}}</td>
                                <td>
                                    <div>
                                        @if($agent[$key]->is_active==0)
                                            <a href="{{url('/admin/agent/active/'.$agent[$key]->id)}}" title="Activate">
                                                <i class="fa fa-arrow-circle-up"></i>
                                            </a>
                                        @else
                                            <a href="{{url('/admin/agent/inactive/'.$agent[$key]->id)}}" title="Inactive">
                                                <i class="fa fa-arrow-circle-down"></i>
                                            </a>
                                        @endif
                                        <a href="{{url('/admin/agent/'.$agent[$key]->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/agent/'.$agent[$key]->id}}')" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>




            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection