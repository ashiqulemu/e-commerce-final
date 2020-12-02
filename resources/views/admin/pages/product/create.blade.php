@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/product')}}" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="form-box-header">
                        + Add Product
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input
                                   class="form-control"
                                   name="name"
                                   type="text"
                                   placeholder="name"
                                   value="{{ old('name') }}"
                            >

                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{--<div class="form-group">--}}
                            {{--<label for="">Offer</label>--}}
                            {{--<select class="js-example-basic-multiple form-control"--}}
                                    {{--name="offer_id"  id="select1">--}}
                                {{--<option value="">Select Offer</option>--}}
                                {{----}}
                                    {{--<option value="{{$off->id}}"--}}
                                    {{--@if (old('offer_id') == $off->id) {{ 'selected' }} @endif>--}}
                                        {{--{{$off->name}}</option>--}}
                                {{----}}
                            {{--</select>--}}
                            {{--@if ($errors->has('offer_id'))--}}
                                {{--<div class="error">{{ $errors->first('offer_id') }}</div>--}}
                            {{--@endif--}}

                        {{--</div>--}}
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Category *</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="category_id"  id="select1">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                    @if (old('category_id') == $category->id) {{ 'selected' }} @endif>
                                        {{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="error">{{ $errors->first('category_id') }}</div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Sub-Category *</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="subcat_id"  id="select1">
                                <option value="">Select Subcategory</option>
                                @foreach($subcat as $subc)
                                    <option value="{{$subc->id}}"
                                    @if (old('subcat_id') == $subc->id) {{ 'selected' }} @endif>
                                        {{$subc->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('subcat_id'))
                                <div class="error">{{ $errors->first('subcat_id') }}</div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Sub-SubCategory *</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="sub_id"  id="select1">
                                <option value="">Select Sub-subcategory</option>
                                @foreach($subsub as $category)
                                    <option value="{{$category->id}}"
                                    @if (old('sub_id') == $category->id) {{ 'selected' }} @endif>
                                        {{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('sub_id'))
                                <div class="error">{{ $errors->first('sub_id') }}</div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Price *</label>
                            <input
                                   class="form-control"
                                   name="price"
                                   type="number"
                                   step="any"
                                   value="{{ old('price') }}"
                                   placeholder="Price">

                            @if ($errors->has('price'))
                                <div class="error">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Agent Price *</label>
                            <input
                                    class="form-control"
                                    name="agent_price"
                                    type="number"
                                    step="any"
                                    value="{{ old('price') }}"
                                    placeholder="Price">

                            @if ($errors->has('price'))
                                <div class="error">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Quantity *</label>
                            <input
                                   class="form-control"
                                   name="quantity"
                                   type="number"
                                   step="any"
                                   value="{{ old('quantity') }}"
                                   placeholder="Quantity">

                            @if ($errors->has('quantity'))
                                <div class="error">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                          <textarea name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">(Weight/Liter/etc)</label>
                            <input
                                   class="form-control"
                                   name="meta_tag"
                                   type="text"
                                   value="{{ old('meta_tag') }}"
                                   placeholder="Product Weight Like KG or LTR">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Meta Description</label>
                         <textarea name="meta_description" class="form-control"
                                   placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="form-control" name="product_image" >
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><br>
                            <label for="">Is Out of Stock? *</label><br>
                            <input type="radio"  name="is_out_of_stock" value="1" id="yes"
                                   @if(old('is_out_of_stock')=='1') checked @endif>
                            <label for="yes">Yes</label>

                            <input type="radio"  name="is_out_of_stock" value="0" id="no"
                                   @if(!old('is_out_of_stock')) checked @endif
                                   @if(old('is_out_of_stock')=='0') checked @endif>
                            <label for="no">No</label>
                            @if ($errors->has('is_out_of_stock'))
                                <div class="error">{{ $errors->first('is_out_of_stock') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><br>
                            <label for="">Status *</label><br>
                            <input type="radio" checked name="status" value="1" id="active"
                                   @if(!old('status')) checked @endif
                                   @if(old('status')=='1') checked @endif
                            >
                            <label for="active">Active</label>

                            <input type="radio" name="status" value="0" id="inactive"
                                   @if(old('status')=='0') checked @endif
                            >
                            <label for="inactive">Inactive</label>
                            @if ($errors->has('status'))
                                <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><br>
                            <label for="">Popular *</label><br>
                            <input type="radio"  name="popular" value="1" id="yes"
                                   @if(old('popular')=='1') checked @endif>
                            <label for="yes">Yes</label>

                            <input type="radio"  name="popular" value="0" id="no"
                                   @if(!old('popular')) checked @endif
                                   @if(old('popular')=='0') checked @endif>
                            <label for="no">No</label>
                            @if ($errors->has('popular'))
                                <div class="error">{{ $errors->first('popular') }}</div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary ml-2" type="submit">submit</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /#page-wrapper -->

@endsection