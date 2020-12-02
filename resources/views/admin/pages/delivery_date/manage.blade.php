@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage Delivery
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Delivery date</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($delivery as $key=>$dd)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$dd->deilivary_date}}</td>
                                <td>{{$dd->quantity}}</td>
                                <td>
                                  <div>
                                      <a href="{{url('/admin/delivery/'.$dd->id).'/edit'}}" title="Edit">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a  href="#" @click.prevent="deleteMe('{{'/admin/delivery/'.$dd->id}}')" title="Delete">
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