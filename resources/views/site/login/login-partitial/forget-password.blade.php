@extends('site.app')
@section('title-meta')
    <title>Forgot Password</title>
@endsection

@section('content')


   <section class="forget-pass">
       <div class="container p-0">
           <div class="row justify-content-center">
               <div class="col-md-8">
                   <div class="p-5 bg-white shadow-sm">
                       <h2>Forgot password ?</h2>
                       <p>please enter your email address below</p>
                       <form method="post" class="mt-5" action="{{ route('password.email') }}">
                           @csrf
                           <input type="email"
                                  placeholder="Enter your email address"
                                  name="email"
                                  value="{{ old('email') }}" required autocomplete="email" autofocus
                                  class="form-control">

                           @if ($errors->has('email'))
                               <span class="text-danger">
                                    <strong>{{$errors->first('email') }}</strong>
                                            </span>
                           @endif

                           <button class="btn-theme mt-3" type="submit">Submit</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>

@endsection



@section('scripts')
    {{--<script>--}}
    {{--function setPromoLink() {--}}
    {{--var val = $('#promoInput').val()--}}
    {{--$('#promoLink').attr('href', '/view-cart?pcode=' + val)--}}
    {{--}--}}

    {{--</script>--}}
@endsection