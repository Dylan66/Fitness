@extends('layouts.pages')

@section('content')
<section class="home-slider-loop-false  inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('/pages/img/slider4.jpg');">

        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Trainers</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END slider -->

<section class="section bg-light element-animate">

    <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center heading-wrap">
                    <h2>Our Trainers</h2>
                    <span class="back-text-dark">Trainers</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row no-gutters">
            @foreach ($trainers as $trainer)
            <div class="col-md-6 mb-3">
                <div class="sched d-block d-lg-flex">
                    <div class="bg-image order-2"
                        style="background-image: url('/storage/uploads/images/{{ $trainer->image }}');"> </div>
                    <div class="text order-1">
                        <h3>{{ $trainer->user->name }}</h3>
                        <p>{{ $trainer->description }}</p>
                        <p class="sched-time">
                            <span><span class="fa fa-star"></span> {{ $trainer->rating }}</span> <br>
                        </p>
                        <p><a href="/bookings/create" class="btn btn-primary btn-sm">Book</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> <!-- .section -->


@endsection