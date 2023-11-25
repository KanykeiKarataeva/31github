@extends('layouts.employee_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <form action="{{route('employee.group.update', $children->id)}}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
            <section class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <img src="{{asset($children->photo)}}" class="img-fluid" alt="Card image" />
                                    <br><br>
                                    <input type="file" class="form-control" id="photo" name="photo" value="" autofocus="">
                                </div>
                                <div class="col-md-10 col-12">
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_name')</p></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="name" name="name" value="{{$children->name}}" required="" autofocus="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_surname')</p></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="surname" name="surname" value="{{$children->surname}}" required="" autofocus="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_birth_date')</p></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{$children->birth_date}}" required="" autofocus="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_gender')</p></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="radioDiv">
                                                <input type="radio" name="gender" id="option-1" value="Male" {{ $children->gender == 'Male' ? 'checked' : ''}}>
                                                <input type="radio" name="gender" id="option-2" value="Female" {{ $children->gender == 'Female' ? 'checked' : ''}}>
                                                <label for="option-1" class="option option-1">
                                                    <div class="dot"></div>
                                                    <span>@lang('lang.gender_male')</span>
                                                </label>
                                                <label for="option-2" class="option option-2">
                                                    <div class="dot"></div>
                                                    <span>@lang('lang.gender_female')</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_parent')</p></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                @foreach($parents as $parent)
                                                    <option value="{{$parent->id}}" {{$parent->id === $children->parent_id ? "selected" : ""}}>{{$parent->name}}  {{$parent->surname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" hidden="">
                                        <div class="col-md-3">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_group')</p></label>
                                        </div>
                                        <div class="col-lg-6" >
                                            <select class="form-control" name="group_id" id="group_id">
                                                    <option value="{{$children->group_id}}">{{$children->group_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_birth_cert')</p></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <img class="img-fluid" src="{{asset($children->birth_certificate)}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="birth_certificate" name="birth_certificate" value=""  autofocus="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_med_cert')</p></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <img class="img-fluid" src="{{asset($children->med_certificate)}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="med_certificate" name="med_certificate" value=""  autofocus="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_med_dis')</p></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <img class="img-fluid" src="{{asset($children->med_disability)}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="med_disability" name="med_disability" value=""  autofocus="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <a href="{{route('employee.group.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</a>
                                    <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.save_btn')</button>
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
