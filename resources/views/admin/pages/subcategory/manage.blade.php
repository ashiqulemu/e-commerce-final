@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage Subcategory
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Name</th>
                            <th>category name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                      <?php for($i=0;$i<sizeof($subcat);$i++){  ?>
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$subcat[$i]->name}}</td>
                                <td>{{$subcat[$i]->cname}}</td>
                                <td>
                                  <div>
                                      <a href="{{url('/admin/subcategory/'.$subcat[$i]->id).'/edit'}}" title="Edit">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a  href="#" @click.prevent="deleteMe('{{'/admin/subcategory/'.$subcat[$i]->id}}')" title="Delete">
                                          <i class="fa fa-trash"></i>
                                      </a>
                                  </div>
                                </td>

                            </tr>

                      <?php }?>

                        </tbody>

                    </table>
                </div>




            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection