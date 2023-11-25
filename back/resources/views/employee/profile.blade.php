@extends('layouts.employee_layout')

@section('content')
{{--    @dd(auth()->user()->id)--}}
    <div class="content-wrapper">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-dismissible white" style="background-color: #9b73f2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status') }}
                </div>
            @endif
            <form class=" row" action="{{route('employee.profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
            <section class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <img src="{{asset($user->profile_photo)}}" class="img-fluid" alt="Card image" />
                                    <br><br>
                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo" value="" autofocus="">
                                </div>
                                <div class="col-md-10 col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">@lang('lang.emp_position')</p>
                                            <p class="mb-0">@lang('lang.emp_position_info')</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">@lang('lang.emp_group_name')</p>
                                            <p class="mb-0">{{$group->group_name}}</p>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required="" autofocus="">
                                                <label for="first-name">@lang('lang.name')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}" required="" autofocus="">
                                                <label for="surname">@lang('lang.surname')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" required="" autofocus="">
                                                <label for="address">@lang('lang.address')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" required="" autofocus="">
                                                <label for="email">@lang('lang.email')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$user->phone_number}}" required="" autofocus="">
                                                <label for="email-address">@lang('lang.phone_number')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-6">
                                        </div>
                                        <div class="col-6">
                                            <img class="img-fluid" src="{{asset($user->passport_front)}}">
                                        </div>
                                        <div class="col-6">
                                            <img class="img-fluid" src="{{asset($user->passport_back)}}">
                                        </div>
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="file" class="form-control" id="passport_front" name="passport_front" value="" autofocus="">
                                                <label for="passport_front">@lang('lang.passport_front')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-6">
                                            <fieldset class="form-label-group">
                                                <input type="file" class="form-control" id="passport_front" name="passport_back" value="" autofocus="">
                                                <label for="passport_back">@lang('lang.passport_back')</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn-gradient-secondary my-1" data-bs-toggle="modal" data-bs-target="#modalUpdate">@lang('lang.save_btn')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                </form>
        </div>
    </div>
@endsection
