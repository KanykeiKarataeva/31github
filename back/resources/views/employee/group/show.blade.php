@extends('layouts.employee_layout')
@section('content')
<div class="content-wrapper">
    <div class="container">
        <section class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-2 col-12">
                                <img src="{{asset($children->photo)}}" class="img-fluid" alt="Card image" />
                            </div>
                            <div class="col-md-10 col-12">
                                <hr/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_name')</p></label>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{$children->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_surname')</p></label>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{$children->surname}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_birth_date')</p></label>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{$children->birth_date}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_gender')</p></label>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{$children->gender}}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_parent')</p></label>
                                    </div>
                                    <div class="col-md-5">
                                        <p>{{$children->parent_name}} {{$children->parent_surname}}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_number')</p></label>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{$children->phone_number}}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_birth_cert')</p></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <img class="img-fluid" src="{{asset($children->birth_certificate)}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_med_cert')</p></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <img class="img-fluid" src="{{asset($children->med_certificate)}}">                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_med_dis')</p></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <img class="img-fluid" src="{{asset($children->med_disability)}}">                                    </div>
                                </div>
                            </div>
                                    <div class="col-12 text-right">
                                        <a href="{{route('employee.group.index')}}">
                                        <button type="submit" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</button>
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection
