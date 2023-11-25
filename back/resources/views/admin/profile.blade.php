@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
    <div class="container">
        <form action="{{route('admin.profile.update', auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="container rounded bg-white">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset($user->profile_photo)}}"><span class="text-black-50">{{$user->email}}</span><span> </span></div>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                    </div>
                    <div class="col-lg-8 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">@lang('lang.admin_profile')</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labels">@lang('lang.name')</label>
                                    <input type="text" class="form-control" placeholder="first name" id="name" name="name" value="{{$user->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">@lang('lang.surname')</label>
                                    <input type="text" class="form-control" value="{{$user->surname}}" id="surname" name="surname" placeholder="surname"></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12"><label class="labels">@lang('lang.phone_number')</label><input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="enter phone number" value="{{$user->phone_number}}"></div>

                                <div class="col-lg-12"><br><label class="labels">@lang('lang.address')</label><input type="text" class="form-control" id="address" name="address" placeholder="enter address" value="{{$user->address}}"></div>

                                <div class="col-lg-12"><br>
                                    <label class="labels">@lang('lang.passport_front')</label>
                                    <br>
                                    <input type="file" class="form-control" id="passport_front" name="passport_front" placeholder="upload passport front" value="">
                                    <br>
                                    <img class="img-fluid" src="{{asset($user->passport_front)}}">
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <label class="labels">@lang('lang.passport_back')</label>
                                    <br>
                                    <input type="file" class="form-control" id="passport_back" name="passport_back" placeholder="upload passport back" value="">
                                    <br>
                                    <img class="img-fluid" src="{{asset($user->passport_back)}}">
                                </div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-gradient-secondary my-1">@lang('lang.save_btn')</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
@endsection
