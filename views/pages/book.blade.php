@extends('layouts.pages')

@section('content')
<section class="home-slider-loop-false  inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('/pages/img/slider2.jpg');">

        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Book now</h1>

                </div>
            </div>
        </div>

    </div>

</section>
<div id="app">
    <book />
</div>


@endsection