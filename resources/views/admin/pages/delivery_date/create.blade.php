@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>

            <form method="post" action="{{url('/admin/delivery')}}" >
               @csrf
                <div class="">
                    <div class="form-box-header">
                        + Add Delivery Date
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Delivery Date</label>
                            <input type="date"
                                   id="datetimepicker"
                                   name="delivery_date"
                                   class="form-control"
                                   value="{{ old('day_start') }}"
                                   placeholder="Start Date"
                                   required >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input
                                    class="form-control"
                                    name="quantity"
                                    type="number"
                                    placeholder="Quantity" required>

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