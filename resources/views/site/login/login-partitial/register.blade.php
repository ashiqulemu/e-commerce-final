
@extends('site.app')

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @else
        @include('site.home-partials.header')
    @endif
    @include('site.home-partials.nav-bar')
    <section class="register">

        <div class="container">

            <div class="row justify-content-center my-3">
                <div class="col-12 col-md-9 form-register p-5">
                    @if (isset($errors) && count($errors))

                        @foreach($errors->all() as $error)
                         <h6 align="center" style="color:darkred">   <li>{{$error }}</li> </h6>
                        @endforeach
                    @endif
                    <div class="row ">
                        <div class="col text-center">
                            <h2>Register</h2>
                            <p class="text-h3">Please fill up the form fields correctly to be a registered person!  </p>
                        </div>

                    </div>
                    <form class="form-horizontal manipulate" method="POST" action="{{ url('/admin/register') }}">
                        @csrf
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control @error('sign_username') is-invalid
                                       @enderror" name="sign_username" value="{{ old('sign_username') }}"
                                   required  placeholder="User Name">
                        </div>
                        @error('sign_username')
                        <div class="invalid-feedback text-right" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="email"  class="form-control @error('sign_email') is-invalid
                                       @enderror" name="sign_email" value="{{ old('sign_email') }}"
                                   required autocomplete="sign_email" placeholder="E-mail Address">
                            @error('sign_email')
                            <div class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="mobile"
                                   value="{{ old('moible') }}" placeholder="Phone/Mobile no">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="password" class="form-control @error('sign_password') is-invalid @enderror"
                                   name="sign_password" required autocomplete="new-password" Placeholder="Password">

                            @error('sign_password')
                            <div class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                    </div>
                   
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                    v-model="termCheck" @input="changeTerm"> &nbsp;
                                    I Accept the <a href="/terms-and-conditions" style="color:#FFA134;">Terms and Conditions</a> and   <a style="color:#FFA134;" href="/privacy-policy">Privacy
                                        Policy.</a>
                                </label>
                            </div>

                            <button class="btn  mt-5 btn-theme">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection