@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
<div class="row site-forms mt-2">
    <form method="post" action="{{url('/admin/offer')}}" enctype='multipart/form-data'>
        @csrf

            <div class="form-box-header">
                + Add Offer
            </div>

        <div class="col-md-12">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input
                            class="form-control"
                            name="name"
                            type="text"
                            placeholder="Name">

                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" name="description" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Image</label>
                    <input
                            class="form-control"
                            name="offer_image"
                            type="file"
                            placeholder="image">

                    @if ($errors->has('offer_image'))
                        <div class="error">{{ $errors->first('offer_image') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Start Time</label>
                    <input type="date"
                           id="datetimepicker"
                           name="day_start"
                           class="form-control"
                           value="{{ old('day_start') }}"
                           placeholder="Start Date"
                    />
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">End Time</label>
                    <input type="date"
                           id="datetimepicker"
                           name="day_end"
                           class="form-control"
                           value="{{ old('day_end') }}"
                           placeholder="End Date"
                    />
                </div>
            </div>
            <!-- <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Percentage </label>
                    <input
                            class="form-control"
                            name="percentage"
                            type="number"
                            step="any"
                            value="{{ old('percentage') }}"
                            placeholder="Percentage">

                    @if ($errors->has('percentage'))
                        <div class="error">{{ $errors->first('percentage') }}</div>
                    @endif
                </div>

            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Price</label>
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
                </div> -->

            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Status</label><br>
                    <input type="radio" checked name="status" value="Active" id="active">
                    <label for="active">Active</label>
                    <input type="radio" name="status" value="Inactive" id="inactive">
                    <label for="inactive">Inactive</label>
                    @if ($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                    @endif
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