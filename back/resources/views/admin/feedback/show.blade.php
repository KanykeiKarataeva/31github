@extends('layouts.admin_layout')
@section('content')
    <style>
        .checked {
            color: orange;
        }
    </style>
    <div class="content-wrapper">
        <div class="container">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">@lang('lang.full')</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>@lang('lang.full_name')</b>
                            <div class="">{{$feedback[0]->name}} {{$feedback[0]->surname}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.feedback_grade')</b>
                            <div class="">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $feedback[0]->stars)
                                        <span class="fa fa-star checked"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.feedback_comment')</b>
                            <div class="">{{$feedback[0]->comment}}</div>
                        </li>
                        @foreach ($feedbacks as $feedback)
                            <tr class="odd">
                                <td>{{$feedback->name}} {{$feedback->surname}}</td>
                                @php $created_at = \Carbon\Carbon::parse($feedback->created_at)->format('Y-m-d '); @endphp
                                <td>{{$created_at}}</td>
                                <td>@for($i = 1; $i <= 5; $i++)
                                        @if($i <= $feedback->stars)
                                            <span class="fa fa-star checked"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                        @endif
                                    @endfor</td>
                                <td>
                                    <div style="float: left;
                                display: block;
                                width: 50%;" class="text-center">
                                        <a href="{{route('admin.feedback.show', $feedback->id)}}"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div style="float: left;
                                display: block;
                                width: 50%;" class="text-center">
                                        <form action="{{route('admin.feedback.delete', $feedback->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                                <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                {{-- td>rfed</td> --}}
                            </tr>
                        @endforeach
                        <li class="list-group-item">
                            <b>@lang('lang.email')</b>
                            <div class="">{{$feedback[0]->email}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.phone_number')</b>
                            <div class="">{{$feedback[0]->phone_number}}</div>
                        </li>
                    </ul>

                    <div class="modal-footer">
                        <a href="{{route('admin.feedback.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.back_btn')</a>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
