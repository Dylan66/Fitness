@extends('layouts.pages')

@section('content')


<section class="home-slider-loop-false  inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('/pages/img/slider4.jpg');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>{{ $service->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END slider -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <p class="mb-5 "><img src="{{ url('/storage/uploads/images/'. $service->image ) }}" alt=""
                        class="img-fluid"></p>
            </div>

            <div class="col-lg-6 pl-2 pl-lg-5">
                <h2 class="mb-5">{{ $service->name }}</h2>
                <p>{{ $service->description }}</p>

            </div>
        </div>
    </div>
</section>

@endsection