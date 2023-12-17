@extends('layouts.admin_layout')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>@lang('lang.welcome_admin')</h1>
        </div>
    </div>
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
@endsection
