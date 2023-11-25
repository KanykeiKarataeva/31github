@extends('layouts.app')

@section('content')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:40px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .checked {
            color: orange;
        }
        .avatar-button {
            font-size: 1.5rem;
            text-align: center;
            overflow: visible;
            border: 0;
            background-color: transparent;
            cursor: pointer;
            margin: 0;
            padding: 0;
            bottom: 0;
        }

        .avatar-text {
            height: 90px;
            width: 90px;
            align-items: center;
            color: #fff;
            display:block;
            background-color: #673ab7;
            font-size: 2.5rem;
            border-radius: 50%;
            vertical-align: center;
            justify-content: center;
            padding: 0.9rem;
        }

    </style>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{asset('new_template/img/IMG_9157.PNG')}}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">@lang('lang.slider_main1')</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">@lang('lang.slider_msg1')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{asset('new_template/img/photo_2023-05-14_22-19-18.jpg')}}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">@lang('lang.slider_main2')</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">@lang('lang.slider_msg2')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facilities Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">@lang('lang.pros_main')</h1>
                <p>@lang('lang.pros_main_msg')</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="facility-item">
                        <div class="facility-icon bg-primary">
                            <span class="bg-primary"></span>
                            <i class="fa fa-bus-alt fa-3x text-primary"></i>
                            <span class="bg-primary"></span>
                        </div>
                        <div class="facility-text bg-primary">
                            <h3 class="text-primary mb-3">@lang('lang.pros_parking')</h3>
                            <p class="mb-0">@lang('lang.pros_parking_msg')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="facility-item">
                        <div class="facility-icon bg-success">
                            <span class="bg-success"></span>
                            <i class="fa fa-futbol fa-3x text-success"></i>
                            <span class="bg-success"></span>
                        </div>
                        <div class="facility-text bg-success">
                            <h3 class="text-success mb-3">@lang('lang.pros_playground')</h3>
                            <p class="mb-0">@lang('lang.pros_playground_msg')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="facility-item">
                        <div class="facility-icon bg-warning">
                            <span class="bg-warning"></span>
                            <i class="fa fa-utensils fa-3x text-warning"></i>
                            <span class="bg-warning"></span>
                        </div>
                        <div class="facility-text bg-warning">
                            <h3 class="text-warning mb-3">@lang('lang.pros_food')</h3>
                            <p class="mb-0">@lang('lang.pros_food_msg')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="facility-item">
                        <div class="facility-icon bg-info">
                            <span class="bg-info"></span>
                            <i class="fa fa-chalkboard-teacher fa-3x text-info"></i>
                            <span class="bg-info"></span>
                        </div>
                        <div class="facility-text bg-info">
                            <h3 class="text-info mb-3">@lang('lang.pros_edu')</h3>
                            <p class="mb-0">@lang('lang.pros_edu_msg')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facilities End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">@lang('lang.info_main')</h1>
                    <p class="mb-4">@lang('lang.info_msg')</p>
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="" hidden="">Read More</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Калыскан Шамшиева</h6>
                                    <small>@lang('lang.ceo')</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-3" src="{{asset('new_template/img/photo_2023-05-14_23-06-25.jpg')}}" alt="">
                        </div>
                        <div class="col-6 text-start" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{asset('new_template/img/photo_2023-05-14_22-19-37.jpg')}}" alt="">
                        </div>
                        <div class="col-6 text-end" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{asset('new_template/img/about-3.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Call To Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100 rounded" src="{{asset('new_template/img/IMG_9155.PNG')}}" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="h-100 d-flex flex-column justify-content-center p-5">
                            <h1 class="mb-4">@lang('lang.hiring_main')</h1>
                            <p class="mb-4">@lang('lang.hiring_msg')</p>
                            <a class="btn btn-primary py-3 px-5" href="{{route('vacancy')}}">@lang('lang.hiring_btn')<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call To Action End -->


    <!-- Classes Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">@lang('lang.reason_main')</h1>
                <p>@lang('lang.reason_msg')</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="{{asset('new_template/img/classes-1.jpg')}}" alt="">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="">@lang('lang.reason1')</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Каныкей Каратаева</h6>
                                        <small>@lang('lang.teacher')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">@lang('lang.age_range')</h6>
                                        <small>3-5 @lang('lang.age')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">@lang('lang.time'):</h6>
                                        <small>9-10 @lang('lang.time_morning')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">@lang('lang.capacity'):</h6>
                                        <small>12 @lang('lang.capacity_info')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="{{asset('new_template/img/photo_2023-05-14_22-19-37.jpg')}}" alt="">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="">@lang('lang.reason2')</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Калыскан Шамшиева</h6>
                                        <small>@lang('lang.teacher')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">@lang('lang.age_range')</h6>
                                        <small>3-7 @lang('lang.age')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">@lang('lang.time')</h6>
                                        <small>10-11 @lang('lang.time_morning')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">@lang('lang.capacity')</h6>
                                        <small>10 @lang('lang.capacity_info')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="{{asset('new_template/img/photo_2023-05-14_23-22-07.jpg')}}" alt="">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="">@lang('lang.reason3')</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Сымбат Султангазиева</h6>
                                        <small>@lang('lang.teacher')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">@lang('lang.age_range'):</h6>
                                        <small>2-7 @lang('lang.age')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">@lang('lang.time')</h6>
                                        <small>12-13 @lang('lang.time_day')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">@lang('lang.capacity')</h6>
                                        <small>12 @lang('lang.capacity_info')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="{{asset('new_template/img/photo_2023-05-14_22-19-34.jpg')}}" alt="">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="">@lang('lang.reason4')</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Бектемир Кумарбай уулу</h6>
                                        <small>@lang('lang.teacher')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">@lang('lang.age_range')</h6>
                                        <small>3-5 @lang('lang.age')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">@lang('lang.time')</h6>
                                        <small>9-10 @lang('lang.time_morning')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">@lang('lang.capacity')</h6>
                                        <small>12 @lang('lang.capacity_info')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="{{asset('new_template/img/photo_2023-05-14_22-19-32.jpg')}}" alt="">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="">@lang('lang.reason5')</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Эмирлан Нурлан уулу</h6>
                                        <small>@lang('lang.teacher')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">@lang('lang.age_range')</h6>
                                        <small>3-5 @lang('lang.age')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">@lang('lang.time')</h6>
                                        <small>9-10 @lang('lang.time_morning')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">@lang('lang.capacity')</h6>
                                        <small>12 @lang('lang.capacity_info')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="{{asset('new_template/img/classes-6.jpg')}}" alt="">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="">@lang('lang.reason6')</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{asset('new_template/img/photo_2023-05-14_22-58-44.jpg')}}" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Сымбат Султангазиева</h6>
                                        <small>@lang('lang.teacher')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">@lang('lang.age_range')</h6>
                                        <small>3-5 @lang('lang.age')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">@lang('lang.time')</h6>
                                        <small>9-10 @lang('lang.time_morning')</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">@lang('lang.capacity')</h6>
                                        <small>12 @lang('lang.capacity_info')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Classes End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">@lang('lang.team')</h1>
                <p>@lang('lang.team_msg')</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <img class="img-fluid rounded-circle w-75" src="{{asset('new_template/img/team-1.jpg')}}" alt="">
                        <div class="team-text">
                            <h6>Каныкей Каратаева</h6>
                            <p>@lang('lang.team1')</p>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <img class="img-fluid rounded-circle w-75" src="{{asset('new_template/img/team-2.jpg')}}" alt="">
                        <div class="team-text">
                            <h6>Бектемир Кумарбай уулу</h6>
                            <p>@lang('lang.team2')</p>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <img class="img-fluid rounded-circle w-75" src="{{asset('new_template/img/team-3.jpg')}}" alt="">
                        <div class="team-text">
                            <h6>Сымбат Султангазиева</h6>
                            <p>@lang('lang.team3')</p>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->

        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">@lang('lang.feedback')</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    @foreach($feedbacks as $feedback)
                        <div class="testimonial-item bg-light rounded p-5">
                            <p class="fs-5">{{$feedback->comment}}</p>
                            <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                                @if($feedback->profile_photo != NULL)
                                    <img class="img-fluid flex-shrink-0 rounded-circle" src="{{asset($feedback->profile_photo)}}" style="width: 90px; height: 90px;">
                                @else
                                    @php $firstLetter = mb_substr($feedback->name, 0, 1); $secondLetter = mb_substr($feedback->surname, 0, 1);@endphp
                                    <button class="avatar-button">
                                        <span class="avatar-text">{{$firstLetter}}{{$secondLetter}}</span>
                                    </button>
                                @endif

                                <div class="ps-3">
                                    <h5 class="mb-1">{{$feedback->name}} {{$feedback->surname}}</h5>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $feedback->stars)
                                            <span class="fa fa-star checked"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                        @endif
                                    @endfor
                                </div>
                                <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(auth()->user())
                    @if(auth()->user()->role != 'ROLE_USER')
                        <div class="d-flex justify-content-center container-xxl py-5">
                            <button type="button" class="btn btn-primary rounded-pill px-3 d-lg-block"
                                    data-bs-toggle="modal" data-bs-target="#feedback" style="font-size: large">
                                @lang('lang.leave_feedback')
                            </button>
                        </div>
                        <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">@lang('lang.feedback_form')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('feedback.create') }}" >
                                            @csrf
                                            <div class="field" hidden="">
                                                <input type="number" id="parent_id" name="parent_id" value="{{auth()->user()->id}}">
                                            </div>
                                            <div class="field">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="stars" value="5" />
                                                    <label for="star5" title="5">5 stars</label>
                                                    <input type="radio" id="star4" name="stars" value="4" />
                                                    <label for="star4" title="4">4 stars</label>
                                                    <input type="radio" id="star3" name="stars" value="3" />
                                                    <label for="star3" title="3">3 stars</label>
                                                    <input type="radio" id="star2" name="stars" value="2" />
                                                    <label for="star2" title="2">2 stars</label>
                                                    <input type="radio" id="star1" name="stars" value="1" />
                                                    <label for="star1" title="1">1 star</label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="field">
                                                <div class="col-12">
                                                    <div class=""><p class="text-purple"></p></div>
                                                    <label for="comment" class="form-label" style="font-weight: 700;">@lang('lang.feedback_comment')</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control border-0" placeholder="Leave a message here" id="comment" name="comment" style="height: 100px; background-color: #eee8fd" ></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary "
                                                        data-bs-dismiss="modal">@lang('lang.cancel')</button>
                                                <!-- <button type="button" class="btn btn-primary">Sign in</button> -->
                                                <button type="submit" class="btn btn-primary btn-block">@lang('lang.saveBtn')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Testimonial End -->


@endsection
