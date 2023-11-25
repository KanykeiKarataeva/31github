@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
            <button type="button" class="btn btn-gradient-primary" style="margin-right:85%;" id="addGroupBtnId" onclick="showForm()">@lang('lang.add_group')</button>
            <div class="d-none" id="addGroupId">
                <form id="form" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">@lang('lang.emp_group_name')</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="teacher" class="col-md-4 col-form-label text-md-end">@lang('lang.teacher')</label>

                        <div class="col-md-6">
                            <select class="form-control col-md-12" name="teacher_id" id="teacher_id" @error('teacher_id') is-invalid @enderror required autocomplete="teacher_id">
                            <option></option>
                            @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->surname}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="limit" class="col-md-4 col-form-label text-md-end">@lang('lang.limit')</label>

                        <div class="col-md-6">
                            <input id="limit" type="number" class="form-control @error('limit') is-invalid @enderror" name="limit" value="{{ old('limit') }}" required autocomplete="limit" autofocus>

                            @error('limit')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">@lang('lang.description')</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="image" class="col-md-4 col-form-label text-md-end">@lang('lang.group_image')</label>

                        <div class="col-md-6">
                            <input id="image" type="file" accept="image/png, image/gif, image/jpeg" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required>

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-gradient-primary my-1" onclick="cancelForm()">@lang('lang.cancel')</button>
                        <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.saveBtn')</button>
                    </div>
                </form>
            </div>
        </div>
            <br>
        <div class="demo-html" style="width: 70%;display: block; margin-left: auto; margin-right: auto;">
            <div class="card-header text-center" >
                <h3>@lang('lang.group_list')</h3>
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
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">
                            @lang('lang.emp_group_name')
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:5%">
                            @lang('lang.limit')
                        </th>
                        <th class="position-relative pr-4" style="text-align:center; vertical-align:middle;overflow:hidden;cursor:pointer;width:45%">
                            @lang('lang.action')
                        </th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByLimit(this.value)"></th>
                    </tr>
                    </thead>
                    <tbody id="groupTable">
                    @foreach ($groups as $group)
                        <tr class="">
                            <td class="">{{$group->id}}</td>
                            <td>{{$group->name}}</td>
                            <td>{{$group->limit}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <a href="{{route('admin.group.show', $group)}}"><i title="show" class="fas fa-eye"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <a href="{{route('admin.group.edit', $group)}}" class="text-success"><i title="edit" class="fas fa-pen"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <form action="{{route('admin.group.delete', $group->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <a href="{{route('admin.group.Gallery', $group)}}" class="text"><i title="add photo or video" class="fas fa-photo-video"></i></a>
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
                let table = document.getElementById('groupTable');
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
            function searchByName(value){
                let table = document.getElementById('groupTable');
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
            function searchByLimit(value){
                let table = document.getElementById('groupTable');
                let rows = table.rows;
                let n = rows.length;
                for(let i = 0; i < n; i++){
                    if(rows[i].cells[2].innerHTML.indexOf(value) === -1){
                        rows[i].className = 'd-none';
                    }
                    else{
                        rows[i].className = '';
                    }
                }
            }
            function showForm(){
                document.getElementById("addGroupBtnId").className = "d-none";
                document.getElementById("addGroupId").className = "col-6";
            }
            function cancelForm(){
                document.getElementById("addGroupBtnId").className = "btn btn-primary";
                document.getElementById("addGroupId").className = "d-none";
            }
            document.getElementById('form').addEventListener("submit", function (event) {
                event.preventDefault()
                let url = "{{route('admin.group.create')}}";
                let name = document.getElementById("name").value;
                let teacher = document.getElementById("teacher_id").value;
                let limit = document.getElementById("limit").value;
                let description = document.getElementById("description").value;
                let image = document.getElementById("image").files[0];
                let data = new FormData();
                data.append("name", name);
                data.append("teacher_id", teacher);
                data.append("limit", limit);
                data.append("description", description);
                data.append("image", image);
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
                        let table = document.getElementById('groupTable');
                        let i = table.rows.length;
                        let row = table.insertRow(i);
                        row.insertCell(0).innerHTML = data.id;
                        row.insertCell(1).innerHTML = data.name;
                        row.insertCell(2).innerHTML = data.limit;
                        row.insertCell(3).innerHTML = `<div class="d-flex">` +
                            `<div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<a href="` + "/admin/group/show/" + data.id + `"><i class="fas fa-eye"></i></a>  </div> ` +
                            `<div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<a href="` + "/admin/group/edit/" + data.id + `" class="text-success"><i class="fas fa-pen"></i></a> ` +
                            `</div> <div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<form action="` + "/admin/group/delete/" + data.id + `" method="POST"> @method('DELETE') @csrf` +
                            `<button title="submit" class="border-0 bg-transparent"> ` +
                            `<i title="delete" class="fas fa-trash text-danger" role="button"></i> </button> </form> </div>` +
                            `<div style="float: left; display: block; width: 30%;" class="text-center"> ` +
                            `<a href="` + "/admin/group/Gallery/" + data.id + `"><i class="fas fa-photo-video"></i></a>  </div> `;
                    })
                    .catch(error => console.log(error))
            })
        </script>
    </div>
@endsection
