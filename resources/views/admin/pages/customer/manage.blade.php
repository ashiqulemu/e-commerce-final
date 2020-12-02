@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage customer
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $key => $customer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->mobile }}</td>
                                <td>{{$customer->email}}</td>
                                <td> {{$customer->is_active ? 'Active' : 'Inactive'}}</td>
                                <td>
                                    <div>
                                        @if($customer->is_active==0)
                                        <a href="{{url('/admin/customer/active/'.$customer->id)}}" title="Inactive">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </a>
                                        @else
                                            <a href="{{url('/admin/customer/inactive/'.$customer->id)}}" title="Active">
                                                <i class="fa fa-arrow-circle-up"></i>
                                            </a>
                                        @endif
                                        <a href="{{url('/admin/customer/'.$customer->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/customer/'.$customer->id}}')" title="Delete">
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

@endsection