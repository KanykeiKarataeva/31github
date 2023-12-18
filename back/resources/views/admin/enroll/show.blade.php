@extends('layouts.admin_layout')
@section('content')

    <div class="content-wrapper">
        <div class="container mb-4 mt-4">
            <form action="{{route('admin.enroll.approve', $enroll->id)}}" method="POST">
                @csrf
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>@lang('lang.child_name')</b>
                            <div class="">{{$enroll->name}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_surname')</b>
                            <div class="">{{$enroll->surname}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_birth_date')</b>
                            <div class="">{{$enroll->birth_date}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_parent')</b>
                            <div class="">{{$enroll->parent->name}} {{$enroll->parent->surname}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_photo')</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($enroll->photo)}}" alt="child's photo" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_birth_cert')</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($enroll->birth_certificate)}}" alt="child's birth certificate" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_med_cert')</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($enroll->med_certificate)}}" alt="child's medical certificate" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_med_dis')</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($enroll->med_disability)}}" alt="child's medical certificate" style="width:70%;">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.child_group')</b>
                            <select class="form-control col-6 groupId @error('groupId') is-invalid @enderror" name="groupId" required autocomplete="name" autofocus>
                                <option selected></option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                            </select>
                            @error('groupId')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.enroll.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</a>
                <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.approve_btn')</button>
            </div>
            </form>
        </div>
    </div>

@endsection

