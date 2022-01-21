@extends('layouts.pages')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('/pages/img/slider1.jpg');">

        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Fitness for life</h1>
                    <p class="mb-5">Think about how the particular exercise is making you feel. If something doesn’t
                        feel right, stop immediately and seek medical advice.</p>
                    <p><a href="/login" class="btn btn-white btn-outline-white">Get Started</a> <a
                            href="/bookings/create" class="btn btn-link btn-white">Book now</a></p>
                </div>
            </div>
        </div>

    </div>

    <div class="slider-item" style="background-image: url('/pages/img/slider2.jpg');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Be a member today</h1>
                    <p class="mb-5">Have at least one recovery day each week to rest. If you are experiencing pain, rest
                        until the pain has gone.</p>
                    <p><a href="#" class="btn btn-white btn-outline-white">Get Started</a>
                        <a href="/bookings/create" class="btn btn-link btn-white">Book now</a></p>
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


<section id="services" class="section element-animate">
    <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center heading-wrap">
                    <h2>Services</h2>
                    <span class="back-text">Our Services</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row">
            @foreach ($services as $service)
            <div class="col-md-6 mb-3">
                <div class="blog d-block d-lg-flex">
                    <div class="bg-image"
                        style="background-image: url('/storage/uploads/images/{{ $service->image }}');"></div>
                    <div class="text">
                        <h3>{{ $service->name }}</h3>

                        <p>{{ $service->description }}</p>

                        <p><a href="/ourservices/{{ $service->id }}" class="btn btn-primary btn-sm">Read More</a></p>

                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>

</section> <!-- .section -->
@endsection