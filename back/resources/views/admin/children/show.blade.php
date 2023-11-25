@extends('layouts.admin_layout')
@section('content')

    <div class="content-wrapper">
        <div class="container mb-4 mt-4">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>@lang('lang.child_name'):</b>
                            <div class="">{{$child->name}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_surname'):</b>
                            <div class="">{{$child->surname}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_birth_date'):</b>
                            <div class="">{{$child->birth_date}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_gender'):</b>
                            <div class="">{{$child->gender}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_parent'):</b>
                            <div class="">{{$child->parent->name}} {{$child->parent->surname}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_group'):</b>
                            <div class="">{{$child->group->name}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_photo'):</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($child->photo)}}" alt="child's photo" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_birth_cert'):</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($child->birth_certificate)}}" alt="child's birth certificate" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_med_cert'):</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($child->med_certificate)}}" alt="child's medical certificate" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_med_dis'):</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($child->med_disability)}}" alt="child's medical disability certificate" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.payment_btn'):</b>
                            <div class="">{{$child->payment}}</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.children.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</a>
            </div>
        </div>
    </div>

@endsection

