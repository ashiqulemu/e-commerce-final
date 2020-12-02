@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>

        <div class="row site-forms">

            <form method="post" action="{{url('/admin/category')}}" enctype='multipart/form-data'>
               @csrf

                    <div class="form-box-header">
                        + Add Category
                    </div>
                <div class="col-md-12 mt-2">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input v-model="name"
                                   class="form-control"
                                   name="name"
                                   type="text"
                                   placeholder="name">

                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input
                                   class="form-control"
                                   name="category_image"
                                   type="file"
                                   placeholder="image">

                            @if ($errors->has('category_image'))
                                <div class="error">{{ $errors->first('category_image') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Category Order</label><br>
                            <input type="radio" checked name="cat_order" value="only" id="only">
                            <label for="active">Only</label>
                            <input type="radio" name="cat_order" value="sub-category" id="sub-category">
                            <label for="inactive">Subcategory</label>
                            <input type="radio"  name="cat_order" value="sub_sub_category" id="sub-category">
                            <label for="inactive">Sub Sub category</label>
                            @if ($errors->has('cat_order'))
                                <div class="error">{{ $errors->first('cat_order') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Status</label><br>
                            <input type="radio" checked name="status" value="Active" id="active">
                            <label for="active">Active</label>
                            <input type="radio" name="status" value="Inactive"id="inactive">
                            <label for="inactive">Inactive</label>
                            @if ($errors->has('status'))
                                <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                    </div>

                </div>
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <button class="btn btn-primary ml-2" type="submit">submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <!-- /#page-wrapper -->

@endsection