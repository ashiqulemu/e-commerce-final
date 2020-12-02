@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>

        <form method="post" action="{{url('/admin/delivery/'.$delivery->id)}}" >
            @csrf
            @method('patch')
            <div class="">
                <div class="form-box-header">
                    + Edit Delivery Date
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
                               value="{{ $delivery->deilivary_date }}"
                               >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input
                                class="form-control"
                                name="quantity"
                                type="number"
                                value="{{ $delivery->quantity}}"
                                placeholder="Quantity" >

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