@extends('admin.admin')

@section('content')

    <div id="page-wrapper" style="overflow-x: hidden">

        <div class="row site-forms mt-2">
            @if (isset($errors) && count($errors))

                @foreach($errors->all() as $error)
                    <h6 align="center" style="color:darkred">
                        <li>{{$error }}</li>
                    </h6>
                @endforeach
            @endif

                    <div class="form-box-header">
                        + Agent
                    </div>
            <form class="form-horizontal manipulate" method="POST" action="{{ url('/admin/agent') }}">
                @csrf

                <div class="col-md-12 mt-2">
                    <div class="col-md-3">
                        <div class="form-group ">

                                <input type="text" class="form-control @error('sign_username') is-invalid
                                       @enderror" name="sign_username" value="{{ old('sign_username') }}"
                                       required placeholder="User Name">

                            @error('sign_username')
                            <div class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group ">

                                <input type="email" class="form-control @error('sign_email') is-invalid
                                       @enderror" name="sign_email" value="{{ old('sign_email') }}"
                                       required autocomplete="sign_email" placeholder="E-mail Address">
                                @error('sign_email')
                                <div class="invalid-feedback text-right" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group ">

                                <input type="number" class="form-control" name="mobile"
                                       value="{{ old('moible') }}" placeholder="Phone/Mobile no">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group ">

                                <input type="password" class="form-control @error('sign_password') is-invalid @enderror"
                                       name="sign_password" required autocomplete="new-password" Placeholder="Password">

                                @error('sign_password')
                                <div class="invalid-feedback text-right" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <button class="btn btn-submit">Submit</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

@endsection

<style>
    .form-horizontal .form-group {
        margin-right: 0!important;
        margin-left: 0!important;
    }
</style>