@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <div class="container">

        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary rounded-pill m-3" id="childInfoBtn" onclick="showChildInfo()">
                @lang('lang.child_info_btn')
            </button>
            <a href="{{route('payment', $child->id)}}">
                <button type="button" class="btn btn-primary rounded-pill m-3"  id="paymentBtn" >
                    @lang('lang.payment_btn')
                </button>
            </a>
        </div>

        <div class="d-none" id="childInfo">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('lang.child_info')</h5>
                        <form id="form" action="{{route('children.update', $child->id)}}" method="post"
                              enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img
                                        src="{{asset($child->photo)}}"
                                        alt="user-avatar"
                                        class="d-block rounded img-fluid"
                                        height="100"
                                        width="100"
                                        id="uploadedAvatar"
                                    />
                                    <div class="">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <input
                                                type="file"
                                                id="photo"
                                                name="photo"
                                                class="account-file-input form-control"
                                            />
                                        </label>
                                        <p class="text-muted mb-0">@lang('lang.profile_photo_msg')</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0"/>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <h6 for="name" class="form-label"><b>@lang('lang.child_name'):</b></h6>
                                        <div class="text-secondary">{{$child->name}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="surname" class="form-label"><b>@lang('lang.child_surname'):</b></h6>
                                        <div class="text-secondary">{{$child->surname}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="email" class="form-label"><b>@lang('lang.child_birth_date'):</b></h6>
                                        <div class="text-secondary">{{$child->birth_date}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 class="form-label" for="phone_number"><b>@lang('lang.child_group'):</b></h6>
                                        <div class="text-secondary">{{$child->group->name}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="address" class="form-label"><b>@lang('lang.child_parent'):</b></h6>
                                        <div
                                            class="text-secondary">{{$child->parent->name}} {{$child->parent->surname}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="address" class="form-label"><b>@lang('lang.child_gender'):</b></h6>
                                        <div class="text-secondary">
                                            @if($child->gender === 'Male')
                                                @lang('lang.gender_male')
                                            @else
                                                @lang('lang.gender_female')
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="birth_certificate" class="form-label"><b>@lang('lang.child_birth_cert'):</b>
                                        </h6>
                                        <input type="file" class="form-control" id="birth_certificate"
                                               name="birth_certificate" placeholder="" value="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="med_certificate" class="form-label"><b>@lang('lang.child_med_cert'):</b></h6>
                                        <input type="file" class="form-control" id="med_certificate"
                                               name="med_certificate">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <img class="img-fluid" src="{{asset($child->birth_certificate)}}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <img class="img-fluid" src="{{asset($child->med_certificate)}}">
                                    </div>
                                    @if($child->med_disability != null)
                                        <div class="mb-3 col-md-6">
                                            <h6 for="med_disability" class="form-label"><b>@lang('lang.child_med_dis'):</b></h6>
                                            <input type="file" class="form-control" id="med_disability"
                                                   name="med_disability" placeholder="" value="">
                                        </div>
                                        <div class="mb-3 col-md-6"></div>
                                        <div class="mb-3 col-md-6">
                                            <img class="img-fluid" src="{{asset($child->med_disability)}}">
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary ms-auto float-end rounded-pill">@lang('lang.save_btn')
                                    </button>
                                    <button type="button" class="btn btn-secondary ms-auto float-end mx-3 rounded-pill"
                                            onclick="hideChildInfo()">@lang('lang.hide_btn')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($galleries != null)
                @php $index = 0; @endphp
                @foreach($created_at_dates as $created_at_date)
                    <div class="card-header rounded-top"
                         style="background-color: #cdb9f8; color: #000000">{{ Carbon::parse($created_at_date)->format('d/m/Y')}}</div>
                    <div class="card-body" style="background-color: #eee8fd; display: flex; align-items: center; justify-content: center">
                        @php $j = 0; @endphp
                        <div id="carouselExampleIndicators{{$index}}" class="carousel slide" data-ride="carousel">
                            @if($count[$index] > 1)
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    @for($i =1 ; $i < $count[$index]; $i++)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                                    @endfor
                                </ol>
                            @endif
                            <div class="carousel-inner" style="max-width: 500px; overflow: hidden">
                                @foreach($galleries as $gallery)
                                    @if($created_at_date === $gallery->created_at)
                                        @if($gallery->video === null)
                                            @if($j === 0)
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{asset($gallery->image)}}" >
                                                </div>
                                                @php $j++; @endphp
                                            @else
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{asset($gallery->image)}}" alt="Second slide">
                                                </div>
                                            @endif
                                        @else
                                            @if($j === 0)
                                                <div class="carousel-item active">
                                                    <video class="d-block w-100" controls >
                                                        <source src="{{asset($gallery->video)}}">.
                                                    </video>
                                                </div>
                                                @php $j++; @endphp
                                            @else
                                                <div class="carousel-item">
                                                    <video class="d-block w-100" controls >
                                                        <source src="{{asset($gallery->video)}}">.
                                                    </video>
                                                </div>
                                            @endif
                                        @endif
                                        @php $text = $gallery->info @endphp
                                    @endif
                                @endforeach
                            </div>
                            @if($count[$index] > 1)
                                <a class="carousel-control-prev" href="#carouselExampleIndicators{{$index}}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators{{$index}}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #eee8fd">
                        <h6>{{$text}}</h6>
                    </div>
                    <br>
                    @php $index++; $text = ""; @endphp
                @endforeach
            @else
                <div class="card-body" style="background-color: #eee8fd; display: flex; align-items: center; justify-content: center">
                    <h4>@lang('lang.gallery_no_data')</h4>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showChildInfo() {
            document.getElementById("childInfo").className = "container-xxl flex-grow-1 container-p-y";
            document.getElementById("childInfoBtn").className = "btn btn-primary rounded-pill m-3";
        }

        function hideChildInfo() {
            document.getElementById("childInfo").className = "d-none";
            document.getElementById("childInfoBtn").className = "btn btn-primary rounded-pill m-3";
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
@endsection
