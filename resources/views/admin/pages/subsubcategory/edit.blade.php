@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/subsub/'.$id)}}" >
                @csrf
                @method('patch')
                <div class="">
                    <div class="form-box-header">
                        Edit Sub-subcategory
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Subcategory ID</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="subcat_id"  id="select1">
                                <option value="">Select Subcategory</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}"
                                    @if (old('subcat_id') == $cat->id) {{ 'selected' }} @endif>
                                        {{$cat->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('subcat_id'))
                                <div class="error">{{ $errors->first('subcat_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Name</label>

                            <input
                                   class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{$subcat->name}}"
                                   placeholder="name">

                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary ml-2" type="submit">Update</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /#page-wrapper -->

@endsection