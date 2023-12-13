@extends('layouts.admin_layout')
@section('content')

    <div class="content-wrapper">
        <div class="container mb-4 mt-4">
            <form action="{{route('admin.enroll.approve', $enroll->id)}}" method="POST">
                @csrf
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
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

