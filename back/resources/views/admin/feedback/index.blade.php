@extends('layouts.admin_layout')
@section('content')
    <style>
        .checked {
            color: orange;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="demo-html" style="width: 70%;display: block; margin-left: auto; margin-right: auto;">
                <div class="card-header text-center" >
                    <h3>@lang('lang.list_feedbacks')</h3>
                    @if (session('status'))
                        <div class="alert alert-dismissible white" style="background-color: #9b73f2">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="position-relative table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr class="table-sm">
                            <th class=""><input class="form-control form-control-sm" value="" oninput="searchByFullName(this.value)"></th>
                        </tr>
                        </thead>
                        <tbody id="resumeTable">
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
                                {{-- td>rfed</td> --}}
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function deletedBtn(button){
                let text = "@lang('lang.delete_question_feedback')";
                if (confirm(text) === true) {
                    button.setAttribute('type', 'submit');
                } else {
                    button.setAttribute('type', 'button');
                }
            }
            function searchByFullName(value){
                let table = document.getElementById('resumeTable');
                let rows = table.rows;
                let n = rows.length;
                for(let i = 0; i < n; i++){
                    if(rows[i].cells[0].innerHTML.indexOf(value) === -1){
                        rows[i].className = 'd-none';
                    }
                    else{
                        rows[i].className = '';
                    }
                }
            }
        </script>
    </div>
@endsection
