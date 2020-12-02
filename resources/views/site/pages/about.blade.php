@extends('site.app')
@section('title-meta')
    <title>About Us</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.login-partitial.header')
        @else
        @include('.site.home-partials.header')
    @endif
    @include('.site.home-partials.nav-bar')
    <div class="container bg-white aboutUS">

        <div class="row p-5 header">
            <h1>About us </h1>
            <h4> Subtitle goes here !</h4>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est eveniet id quaerat temporibus. Est
                molestias pariatur quia. Aliquam, ea eaque illum iure necessitatibus officiis recusandae ut velit. Eaque
                ipsum maxime sequi soluta. Esse, nesciunt, quae! Accusamus, ad aliquam animi beatae corporis cum esse,
                ipsa labore modi nam nemo officia officiis, quis reiciendis ullam vitae voluptate? Atque consequuntur
                deserunt et itaque nihil quod repellat, sit voluptate? Accusamus at beatae commodi cupiditate dicta
                ducimus excepturi fugit labore magnam minima minus molestias natus nemo non omnis perspiciatis quod
                repellendus sapiente sit, tempora totam ullam vel voluptas. Architecto aspernatur assumenda beatae, cum
                cumque deleniti dignissimos dolore dolorum ducimus ea eius maiores minima nobis officia pariatur,
                quibusdam quidem saepe tenetur, veniam voluptates! Ea, rerum, sint. Architecto dolorum esse id
                laboriosam molestiae officia praesentium? Architecto distinctio eveniet explicabo id, in itaque laborum
                libero magnam minima mollitia nisi obcaecati perferendis quae quasi quibusdam reiciendis reprehenderit
                temporibus totam!
            </p>

        </div>
    </div>

@endsection



@section('scripts')
@endsection