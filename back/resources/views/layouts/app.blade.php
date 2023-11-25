<?php
$l = request()->segment(1, '');
$lang = url()->current();
$k = Route::current()->uri;

$langru = "";
$langkg = "";
if($l == "ru"){
    $langru = $lang;
    $langkg = str_replace("/ru", "", $lang);
}
else if($l == ""){
    $langru = $lang.'/ru';
    $langkg = $lang;
}
else{
    $langru = str_replace($k, "ru/".$k, $lang);
    $langkg = $lang;
}

?>

{{--@dd($k, $langru, $langkg, $l, $lang)--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Aruu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
{{--    <link href="{{asset('new_template/img/aruu%20logo1.png')}}" rel="icon">--}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('new_template/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('new_template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('new_template/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('new_template/css/style.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
</head>

<body>
<style>


    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: relative;
        background-color: #f9f9f9;
        width: 140px;
    }

    .dropbtnru
    {
        background: url('http://icons.iconarchive.com/icons/custom-icon-design/flag-3/16/Russia-Flag-icon.png') no-repeat left center;
        padding-left: 25px;
        width: auto;
    }
    .dropbtnkg
    {
        background: url('https://icons.iconarchive.com/icons/famfamfam/flag/16/kg-icon.png') no-repeat left center;
        padding-left: 25px;
        width: auto;
    }

    .dropbtnkg::after {
        /*background: rgba(0, 0, 0, 0) url("https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_keyboard_arrow_down_48px-16.png") no-repeat scroll center center;*/
        content: "";
        height: 16px;
        position: absolute;
        right: 0;
        top: 7px;
        width: 16px;
    }




    .dropdown-content a:first-child
    {
        background: url('http://icons.iconarchive.com/icons/custom-icon-design/flag-3/16/Russia-Flag-icon.png') no-repeat left center;
    }

    .dropdown-content a:last-child
    {
        background: url('https://icons.iconarchive.com/icons/famfamfam/flag/16/kg-icon.png') no-repeat left center;
    }

    /* Links inside the dropdown */

    /* Change color of dropdown links on hover */

    /*# sourceMappingURL=style.css.map */
</style>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">@lang('lang.loading_msg')</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
        <a href="" class="navbar-brand">
            <h1 class="m-0 text-primary">
                <a href="{{route('index')}}">
                    <img src="{{asset('new_template/img/aruu%20logo1.png')}}" style="height: 100px; width: 100px" alt="">
                    <img src="{{asset('new_template/img/aruu%20logo2.png')}}" style="height: 100px; width: 100px">
                </a>
            </h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                @if(auth()->user())
                    @if(auth()->user()->role === 'ROLE_ADMIN' or auth()->user()->role === 'ROLE_TEACHER' or auth()->user()->role === 'ROLE_PARENT')
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">@lang('lang.my_children')</a>
                            <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                                @foreach($children as $child)
                                    <a href="{{route('children', $child->id)}}" class="dropdown-item">{{$child->name}} {{$child->surname}}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">@lang('lang.for_parents')</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                        <a href="{{route('faq')}}" class="dropdown-item">@lang('lang.parents_question')</a>
                        <a href="{{route('literature')}}" class="dropdown-item">@lang('lang.parents_reading')</a>

                    </div>
                </div>
                <div class="nav-item">
                    <a href="{{route('condition')}}" class="nav-link">@lang('lang.conditions')</a>
                </div>
                <div class="nav-item dropdown">
                    <a href="{{route('gallery')}}" class="nav-link">Галерея</a>
                </div>
                <div class="nav-item">
                    <a href="{{route('contact')}}" class="nav-link">@lang('lang.contact')</a>
                </div>
                <div class="nav-item">
                    <a href="{{route('vacancy')}}" class="nav-link">@lang('lang.vacancy')</a>
                </div>
            </div>
            @if(auth()->user())
                <div class="navbar-nav mx-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary rounded-pill px-3 d-lg-block"
                            data-bs-toggle="modal" data-bs-target="#modalEnroll">
                        @lang('lang.enroll')
                    </button>
                </div>
                <div class="navbar-nav mx-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://w7.pngwing.com/pngs/364/361/png-transparent-account-avatar-profile-user-avatars-icon.png" alt="Avatar" style="vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;">
                        </a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0" style="right: 0;left: auto;!important;">
                            @if(auth()->user()->role === 'ROLE_ADMIN')
                                <a href="{{route('admin')}}" class="dropdown-item" >@lang('lang.emp_page')</a>
                            @elseif(auth()->user()->role==='ROLE_TEACHER')
                                <a href="{{route('employee', auth()->user()->id)}}" class="dropdown-item" >@lang('lang.emp_page')</a>
                            @else
                                <a href="{{route('profile', auth()->user()->id)}}" class="dropdown-item" >@lang('lang.user_profile')</a>
                            @endif
                            <a class="dropdown-item" onclick="location.href='{{route('user.logout')}}'" type="button">@lang('lang.log_out')</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="navbar-nav mx-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary rounded-pill px-3 d-lg-block"
                            data-bs-toggle="modal" data-bs-target="#modalMessage">
                        @lang('lang.enroll')
                    </button>
                </div>
                <div class="navbar-nav mx-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://w7.pngwing.com/pngs/364/361/png-transparent-account-avatar-profile-user-avatars-icon.png" alt="Avatar" style="vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;">
                        </a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0" style="right: 0;left: auto;!important;">
                            <a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalSignIn">@lang('lang.log_in')</a>
                            <a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalSignUp">@lang('lang.sign_up')</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="navbar-nav mx-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi-globe" style="font-size: 25px; color: #5f1dea"></i>
                    </a>
                    <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0" style="padding:10px; right: 0; left: auto;!important;">
                        <div class="dropbtnru"><a href="{{ $langru }}" class="dropdown-item">Русский</a></div>
                        <div class="dropbtnkg"><a href="{{ $langkg }}" class="dropdown-item">Кыргызча</a></div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
        <div id="app">
            <main class="py-4">
                <!-- Modal Message -->
                <div class="modal fade" id="modalMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="z-index: 9999">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <!-- Email input -->
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="email">@lang('lang.not_user_msg')</label>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn-block"
                                                data-bs-toggle="modal" data-bs-target="#modalSignIn">
                                            @lang('lang.log_in')
                                        </button>
                                        <button type="button" class="btn btn-primary btn-block"
                                                data-bs-toggle="modal" data-bs-target="#modalSignUp">
                                            @lang('lang.sign_up')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal SignIN -->
                <div class="modal fade" id="modalSignIn" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.log_in')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('user.auth') }}" >
                                    @csrf
                                    <!-- Email input -->
                                    <div class="field">
                                        <i class="icon fas fa-user"></i>
                                        <input type="email" id="email" name="email" placeholder="@lang('lang.email')" class="login__input @error('email') is-invalid @enderror" required autocomplete="email">
                                        @if(session('errorWithEmail'))
                                            <p class="text-danger">{{session('errorWithEmail')}}</p>
                                            <script>
                                                document.getElementById('email').value = "{{session('email')}}";
                                            </script>
                                        @endif
                                    </div>
                                    <div class="field">
                                        <i class="icon fas fa-lock"></i>
                                        <input type="password" id="password" name="password" placeholder="@lang('lang.password')" class="login__input @error('password') is-invalid @enderror" required autocomplete="new-password">
                                        @if(session('errorWithPassword'))
                                            <p class="text-danger">{{session('errorWithPassword')}}</p>
                                            <script>
                                                document.getElementById('email').value = "{{session('email')}}";
                                            </script>
                                        @endif
                                    </div>


                                    <!-- 2 column grid layout for inline styling -->
                                    <div class="row">
                                        <!-- Simple link -->
                                        <a href="{{route('reset.password.form')}}">@lang('lang.forgotten_password')</a>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary "
                                                data-bs-dismiss="modal">@lang('lang.close_btn')</button>
                                        <!-- <button type="button" class="btn btn-primary">Sign in</button> -->
                                        <button type="submit" class="btn btn-primary btn-block">@lang('lang.log_in')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal SignUP -->
                <div class="modal fade" id="modalSignUp" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.sign_up')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Name input -->
                                    <div class="field">
                                        <i class="icon fas fa-user"></i>
                                        <input type="text" id="name" name="name" placeholder="@lang('lang.name')" class="login__input @error('name') is-invalid @enderror" required autocomplete="name">
                                        @if(session('errorWithName'))
                                            <p class="text-danger">{{session('errorWithName')}}</p>
                                            <script>
                                                document.getElementById('name').value = "{{session('name')}}";
                                            </script>
                                        @endif
                                    </div>
                                    <!-- Surname input -->
                                    <div class="field">
                                        <i class="icon fas fa-user"></i>
                                        <input type="text" id="surname" name="surname" placeholder="@lang('lang.surname')" class="login__input @error('surname') is-invalid @enderror" required autocomplete="surname">
                                        @if(session('errorWithSurname'))
                                            <p class="text-danger">{{session('errorWithSurname')}}</p>
                                            <script>
                                                document.getElementById('surname').value = "{{session('surname')}}";
                                            </script>
                                        @endif
                                    </div>

                                    <!-- Home Address input -->
                                    <div class="field">
                                        <i class="icon fas fa-map-marker-alt"></i>
                                        <input type="text" id="address" name="address" placeholder="@lang('lang.address')" class="login__input @error('address') is-invalid @enderror" required autocomplete="address">
                                        @if(session('errorWithAddress'))
                                            <p class="text-danger">{{session('errorWithAddress')}}</p>
                                            <script>
                                                document.getElementById('address').value = "{{session('address')}}";
                                            </script>
                                        @endif
                                    </div>

                                    <!-- Phone Number input -->
                                    <div class="field">
                                        <i class="icon fas fa-phone-alt"></i>
                                        <input type="text" id="phone_number" name="phone_number" placeholder="@lang('lang.phone_number')" class="login__input @error('phone_number') is-invalid @enderror" required autocomplete="phone_number">
                                        @if(session('errorWithPhoneNumber'))
                                            <p class="text-danger">{{session('errorWithPhoneNumber')}}</p>
                                            <script>
                                                document.getElementById('phone_number').value = "{{session('phone_number')}}";
                                            </script>
                                        @endif
                                    </div>
                                    <!-- Email input -->
                                    <div class="field">
                                        <i class="icon fas fa-at"></i>
                                        <input type="email" id="email" name="email" placeholder="@lang('lang.email')" class="login__input @error('email') is-invalid @enderror" required autocomplete="email">
                                        @if(session('errorWithEmail'))
                                            <p class="text-danger">{{session('errorWithEmail')}}</p>
                                            <script>
                                                document.getElementById('email').value = "{{session('email')}}";
                                            </script>
                                        @endif
                                    </div>

                                    <!-- Password input -->
                                    <div class="field">
                                        <i class="icon fas fa-lock"></i>
                                        <input type="password" id="password" name="password" placeholder="@lang('lang.password')" class="login__input @error('password') is-invalid @enderror" required autocomplete="new-password">
                                        @if(session('errorWithPassword'))
                                            <p class="text-danger">{{session('errorWithPassword')}}</p>
                                            <script>
                                                document.getElementById('email').value = "{{session('email')}}";
                                            </script>
                                        @endif
                                    </div>

                                    <!-- Passport front input -->
                                    <div class="field">
                                        <label for="fileF" class="form-label">@lang('lang.passport_front')</label>
                                        <input id="passport_front" type="file" class="form-control @error('passport_front') is-invalid @enderror" name="passport_front" value="{{ old('passport_front') }}">

                                        @error('passport_front')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>

                                    <!-- Passport back input -->
                                    <div class="field">
                                        <label for="fileB" class="form-label">@lang('lang.passport_back')</label>
                                        <input id="passport_back" type="file" class="form-control @error('passport_back') is-invalid @enderror" name="passport_back" value="{{ old('passport_back') }}">

                                        @error('passport_back')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">@lang('lang.close_btn')</button>
                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-success btn-block">@lang('lang.next_btn')</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Enroll -->
                <div class="modal fade"  id="modalEnroll" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.enroll_child')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form id="form" method="POST" action="{{route('enroll.create')}}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Name input -->
                                    <div class="field">
                                        <i class="icon fas fa-user"></i>
                                        <input type="text" id="name" name="name" placeholder="@lang('lang.child_name')" class="login__input @error('name') is-invalid @enderror" required autocomplete="name">
                                        @if(session('errorWithName'))
                                            <p class="text-danger">{{session('errorWithName')}}</p>
                                            <script>
                                                document.getElementById('name').value = "{{session('name')}}";
                                            </script>
                                        @endif
                                    </div>
                                    <!-- Surname input -->
                                    <div class="field" >
                                        <i class="icon fas fa-user"></i>
                                        <input type="text" id="surname" name="surname" placeholder="@lang('lang.child_surname')" class="login__input @error('surname') is-invalid @enderror" required autocomplete="surname">
                                        @if(session('errorWithSurname'))
                                            <p class="text-danger">{{session('errorWithSurname')}}</p>
                                            <script>
                                                document.getElementById('surname').value = "{{session('surname')}}";
                                            </script>
                                        @endif
                                    </div>
                                    <!-- Birth date input -->
                                    <div class="form-outline mb-2" style="padding: 10px">
                                        <label for="birth_date" class="form-label" style="font-weight: 700;">@lang('lang.child_birth_date')</label>
                                        <div class="col-md-6 ">
                                            <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autofocus oninvalid="this.setCustomValidity('Please fill in the field')" oninput="this.setCustomValidity('')">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Gender input -->
                                    <div class="form-outline mb-2" style="padding: 10px">
                                        <label for="gender" class="form-label" style="font-weight: 700;">@lang('lang.child_gender')</label>
                                        <div class="col-md-6">
                                            <div class="radioDiv">
                                                <input type="radio" name="gender" id="option-1" value="Male">
                                                <input type="radio" name="gender" id="option-2" value="Female">
                                                <label for="option-1" class="option option-1">
                                                    <div class="dot"></div>
                                                    <span>@lang('lang.gender_male')</span>
                                                </label>
                                                <label for="option-2" class="option option-2">
                                                    <div class="dot"></div>
                                                    <span>@lang('lang.gender_female')</span>
                                                </label>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Photo input -->
                                    <div class="form-outline mb-2" style="padding: 10px">
                                        <label for="photo" class="form-label" style="font-weight: 700;">@lang('lang.child_photo')</label>
                                        <div class="col-md-6">
                                            <input id="photo" type="file" accept="image/png, image/gif, image/jpeg" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" required autofocus oninvalid="this.setCustomValidity('Please select a file')" oninput="this.setCustomValidity('')">
                                            @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Birth certificate input -->
                                    <div class="form-outline mb-2" style="padding: 10px">
                                        <label for="birth_certificate" class="form-label" style="font-weight: 700;">@lang('lang.child_birth_cert')</label>
                                        <div class="col-md-6">
                                            <input id="birth_certificate" type="file"  class="form-control @error('birth_certificate') is-invalid @enderror" name="birth_certificate" value="{{ old('birth_certificate') }}" required autofocus oninvalid="this.setCustomValidity('Please select a file')" oninput="this.setCustomValidity('')">
                                            @error('birth_certificate')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Med certificate input -->
                                    <div class="form-outline mb-2" style="padding: 10px">
                                        <label for="med_certificate" class="form-label" style="font-weight: 700;">@lang('lang.child_med_cert')</label>
                                        <div class="col-md-6">
                                            <input id="med_certificate" type="file" class="form-control @error('med_certificate') is-invalid @enderror" name="med_certificate" value="{{ old('med_certificate') }}" required autofocus oninvalid="this.setCustomValidity('Please select a file')" oninput="this.setCustomValidity('')">
                                            @error('med_certificate')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Med disability input -->
                                    <div class="form-outline mb-2" style="padding: 10px">
                                        <label for="med_disability" class="form-label" style="font-weight: 700;">@lang('lang.child_med_dis')</label>
                                        <div class="col-md-6">
                                            <input id="med_disability" type="file" class="form-control @error('med_disability') is-invalid @enderror" name="med_disability" value="{{ old('med_disability') }}">
                                            @error('med_disability')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">@lang('lang.close_btn')</button>
                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-success btn-block">@lang('lang.to_enroll')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </main>
        </div>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">@lang('lang.contact')</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>@lang('lang.ftr_address')</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+996 770 10 30 10</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>kindergartenaruu@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-whatsapp"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">@lang('lang.ftr_link')</h3>
                    <a class="btn btn-link text-white-50" href="">@lang('lang.contact')</a>
                    <a class="btn btn-link text-white-50" href="">@lang('lang.conditions')</a>
                    <a class="btn btn-link text-white-50" href="{{route('vacancy')}}">@lang('lang.vacancy')</a>
                    <a class="btn btn-link text-white-50" href="{{route('gallery')}}">Галерея</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="position-relative h-100">
                        <iframe class="position-relative rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1525.4065374147297!2d71.7189939!3d40.124168999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38bbedf2e5dc890f%3A0x54b20d73a0a38c62!2z0JTQtdGC0YHQutC40Lkg0YHQsNC0INCQ0YDRg9GD!5e0!3m2!1sru!2skg!4v1684086382078!5m2!1sru!2skg"
                                frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Kindergarten Aruu</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        <br>Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>--}}
<script src="{{asset('new_template/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('new_template/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('new_template/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('new_template/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- Template Javascript -->
<script src="{{asset('new_template/js/main.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
</body>
</html>
