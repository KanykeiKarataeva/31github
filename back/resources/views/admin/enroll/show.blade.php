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
            </form>
        </div>
    </div>

@endsection

