@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/agent/'.$agent->id)}}" >
                @csrf
                @method('patch')
                <div class="">
                    <div class="form-box-header">
                        Edit Agent
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control @error('sign_username') is-invalid
                                       @enderror" name="sign_username" value="{{ $agent->name}}">
                        </div>
                        @error('sign_username')
                        <div class="invalid-feedback text-right" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email"  class="form-control @error('sign_email') is-invalid
                                       @enderror" name="sign_email" value="{{$agent->email }}"
                                   placeholder="E-mail Address">
                            @error('sign_email')
                            <div class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" class="form-control" name="mobile"
                                   value="{{$agent->mobile}}" placeholder="Phone/Mobile no">
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