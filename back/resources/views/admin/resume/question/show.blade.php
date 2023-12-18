@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container mb-4 mt-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>@lang('lang.question'):</b>
                            <div class="">{{$question->question}}</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.resume.question.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</a>
            </div>
        </div>
    </div>
@endsection
