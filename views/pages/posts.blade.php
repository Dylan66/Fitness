@extends('layouts.pages')

@section('content')


<section class="home-slider-loop-false  inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('/pages/img/slider4.jpg');">

        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Guidelines</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END slider -->


<section id="services" class="section element-animate">
    <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center heading-wrap">
                    <h2>Guidlines</h2>
                    <span class="back-text">Guidelines</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-6 mb-3">
                <div class="blog d-block d-lg-flex">
                    <div class="bg-image" style="background-image: url('/storage/uploads/images/{{ $post->image }}');">
                    </div>
                    <div class="text">
                        <h3>{{ $post->title }}</h3>

                        <p>{{ $post->body }}</p>

                        <p><a href="/posts/{{ $post->id }}" class="btn btn-primary btn-sm">Read More</a></p>

                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>

</section> <!-- .section -->

@endsection