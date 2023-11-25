@extends('layouts.admin_layout')
@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$resume->full_name}}</h3>
                <div class="text-center">
                    <h5>{{$resume->phone_number}}:</h5>
                </div>
                <ul class="list-group list-group-unbordered mb-3">

                    @foreach($answers as $answer)
                        @if($answer->resume_id === $resume->id)
                    <li class="list-group-item">
                        <p><b>{{$answer->question}}:</b></p>
                        <div class="">{{$answer->answers}}</div>
                    </li>
                        @endif
                    @endforeach

                    <li class="list-group-item">
                        <b>CV:</b>
                        <div class="">
                            <img class="img-fluid" src="{{asset($resume->resume)}}" alt="" style="width:70%;">
                        </div>
                    </li>
                </ul>

                <div class="modal-footer">
                    <a href="{{route('admin.resume.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
