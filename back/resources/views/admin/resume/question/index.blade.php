@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
            <button type="button" class="btn btn-gradient-primary"  style="margin-right:85%;" id="addQuestionBtnId" onclick="showForm()">Add Question</button>
            <div class="d-none" id="addQuestionId">
                <form id="form">
                    <div class="row mb-3">
                        <label for="question" class="col-md-4 col-form-label text-md-end">{{ __('Question') }}</label>
                        <textarea
                            id="question"
                            name="question"
                            rows="5"
                            cols="50"
                            placeholder="Write a new question..."></textarea>
                    </div>
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-gradient-primary my-1" onclick="cancelForm()">@lang('lang.cancel')</button>
                        <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.saveBtn')</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="demo-html" style="width: 70%;display: block; margin-left: auto; margin-right: auto;">
            <div class="card-header text-center" >
                <h3>@lang('lang.question_list')</h3>
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
                    <tr>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:5%">
                            id
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:50%">
                            @lang('lang.question')
                        </th>
                        <th class="position-relative pr-4" style="text-align: center;vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">
                            @lang('lang.action')
                        </th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByQuestion(this.value)"></th>
                    </tr>
                    </thead>
                    <tbody id="questionTable">
                    @foreach ($questions as $question)
                        <tr class="odd">
                            <td class="sorting_1">{{$question->id}}</td>
                            <td>{{$question->question}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 30%;" class="text-center">
                                    <a href="{{route('admin.resume.question.show', $question)}}"><i class="fas fa-eye"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 30%;" class="text-center">
                                    <a href="{{route('admin.resume.question.edit', $question)}}" class="text-success"><i class="fas fa-pen"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 30%;" class="text-center">
                                    <form action="{{route('admin.resume.question.delete', $question->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function deletedBtn(button){
                let text = "@lang('lang.delete_question_group')";
                if (confirm(text) === true) {
                    button.setAttribute('type', 'submit');
                } else {
                    button.setAttribute('type', 'button');
                }
            }
            function searchById(value){
                let table = document.getElementById('questionTable');
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
            function searchByQuestion(value){
                let table = document.getElementById('questionTable');
                let rows = table.rows;
                let n = rows.length;
                for(let i = 0; i < n; i++){
                    if(rows[i].cells[1].innerHTML.indexOf(value) === -1){
                        rows[i].className = 'd-none';
                    }
                    else{
                        rows[i].className = '';
                    }
                }
            }
            function showForm(){
                document.getElementById("addQuestionBtnId").className = "d-none";
                document.getElementById("addQuestionId").className = "col-6";
            }
            function cancelForm(){
                document.getElementById("addQuestionBtnId").className = "btn btn-gradient-primary";
                document.getElementById("addQuestionId").className = "d-none";
                //document.getElementById("question").reset();
            }
            document.getElementById('form').addEventListener("submit", function (event) {
                event.preventDefault()
                let url = "{{route('admin.resume.question.create')}}";
                let question = document.getElementById("question").value;
                let data = new FormData();
                data.append("question", question);
                fetch(url, {
                    method: 'POST',
                    body: data
                })
                    .then(res => res.json())
                    .then(data => {
                        cancelForm();
                        let empty = document.getElementsByClassName('dataTables_empty');
                        if(empty.length){
                            empty[0].outerHTML = '';
                        }
                        let table = document.getElementById('questionTable');
                        let i = table.rows.length;
                        let row = table.insertRow(i);
                        row.insertCell(0).innerHTML = data.id;
                        row.insertCell(1).innerHTML = data.question;
                        row.insertCell(2).innerHTML = `<div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<a href="` + "/admin/resume/question/show/" + data.id + `"><i class="fas fa-eye"></i></a>  </div> ` +
                            `<div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<a href="` + "/admin/resume/question/edit/" + data.id + `" class="text-success"><i class="fas fa-pen"></i></a> ` +
                            `</div> <div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<form action="` + "/admin/resume/question/delete/" + data.id + `" method="POST"> @method('DELETE') @csrf` +
                            `<button title="submit" class="border-0 bg-transparent"> ` +
                            `<i title="submit" class="fas fa-trash text-danger" role="button"></i> </button> </form> </div>`;
                    })
                    .catch(error => console.log(error))
                document.getElementById("question").value = '';
                console.log("something")
            })
        </script>
    </div>
@endsection
