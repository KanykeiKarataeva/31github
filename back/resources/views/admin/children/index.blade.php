@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
            <button type="button" class="btn btn-gradient-primary" style="margin-right:85%;" id="addChildBtnId" onclick="showForm()">@lang('lang.add_child')</button>
            <div class="d-none" id="addChildId">
                <form id="form" method="POST" action="{{route('admin.children.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">@lang('lang.child_name')</label>
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
                        <label for="surname" class="col-md-4 col-form-label text-md-end">@lang('lang.child_surname')</label>
                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="birth_date" class="col-md-4 col-form-label text-md-end">@lang('lang.child_birth_date')</label>
                        <div class="col-md-6">
                            <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date">
                            @error('birth_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="gender" class="col-md-4 col-form-label text-md-end">@lang('lang.child_gender')</label>
                        <div class="col-lg-6">
                            <div class="radioDiv">
                                <input type="radio" name="gender" id="option-1" value="Male">
                                <input type="radio" name="gender" id="option-2" value="Female">
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

                    <div class="row mb-3">
                        <label for="parent_id" class="col-md-4 col-form-label text-md-end">@lang('lang.child_parent')</label>
                        <div class="col-md-6">
                            <select class="form-control col-md-12" name="parent_id" id="parent_id" @error('parent_id') is-invalid @enderror required autocomplete="parent_id">
                                <option></option>
                                @foreach($parents as $parent)
                                    <option value="{{$parent->id}}">{{$parent->name}}  {{$parent->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="group_id" class="col-md-4 col-form-label text-md-end">@lang('lang.child_group')</label>
                        <div class="col-md-6">
                            <select class="form-control col-md-12" name="group_id" id="group_id" @error('group_id') is-invalid @enderror required autocomplete="group_id">
                                <option></option>
                                @foreach($groups as $group)
                                    @if($amount_child_group[$group->id] < $group->limit)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @else
                                        <option value="{{$group->id}}" disabled>{{$group->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="photo" class="col-md-3 col-form-label text-md-end">@lang('lang.child_photo')</label>
                        <div class="col-md-4">
                            <input id="photo" type="file" accept="image/png, image/gif, image/jpeg" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}">
                            @error('photo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="birth_certificate" class="col-md-5 col-form-label text-md-end">@lang('lang.child_birth_cert')</label>
                        <div class="col-md-4">
                            <input id="birth_certificate" type="file" accept="image/png, image/gif, image/jpeg" class="form-control @error('birth_certificate') is-invalid @enderror" name="birth_certificate" value="{{ old('birth_certificate') }}">
                            @error('birth_certificate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-lg-1">
                        <label for="med_certificate" class="col-md-5 col-form-label text-md-end">@lang('lang.child_med_cert')</label>
                        <div class="col-md-4">
                            <input id="med_certificate" type="file" accept="image/png, image/gif, image/jpeg" class="form-control @error('med_certificate') is-invalid @enderror" name="med_certificate" value="{{ old('med_certificate') }}">
                            @error('med_certificate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="med_disability" class="col-md-8 col-form-label text-md-end">@lang('lang.child_med_dis')</label>
                        <div class="col-md-4">
                            <input id="med_disability" type="file" accept="image/png, image/gif, image/jpeg" class="form-control @error('med_disability') is-invalid @enderror" name="med_disability" value="{{ old('med_disability') }}">
                            @error('med_disability')
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
                <h3>@lang('lang.children_list')</h3>
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
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">
                            @lang('lang.child_name')
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">
                            @lang('lang.child_surname')
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">
                            @lang('lang.child_group')
                        </th>
                        <th class="position-relative pr-4" style="text-align: center;vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">
                            @lang('lang.action')
                        </th>
                        {{-- <th width="2px"></th> --}}
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchBySurname(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByGroupName(this.value)"></th>
                    </tr>
                    </thead>
                    <tbody id="childTable">
                    @foreach ($children as $child)
                        <tr class="odd">
                            <td class="sorting_1">{{$child->id}}</td>
                            <td>{{$child->name}}</td>
                            <td>{{$child->surname}}</td>
                            <td>{{$child->group->name}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 30%;" class="text-center">
                                    <a href="{{route('admin.children.show', $child)}}"><i class="fas fa-eye"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 30%;" class="text-center">
                                    <a href="{{route('admin.children.edit', $child)}}" class="text-success"><i class="fas fa-pen"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 30%;" class="text-center">
                                    <form action="{{route('admin.children.delete', $child->id)}}" method="POST">
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
                let table = document.getElementById('childTable');
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
                let table = document.getElementById('childTable');
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
            function searchBySurname(value){
                let table = document.getElementById('childTable');
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
            function searchByGroupName(value){
                let table = document.getElementById('childTable');
                let rows = table.rows;
                let n = rows.length;
                for(let i = 0; i < n; i++){
                    if(rows[i].cells[3].innerHTML.indexOf(value) === -1){
                        rows[i].className = 'd-none';
                    }
                    else{
                        rows[i].className = '';
                    }
                }
            }
            function showForm(){
                document.getElementById("addChildBtnId").className = "d-none";
                document.getElementById("addChildId").className = "col-8";
            }
            function cancelForm(){
                document.getElementById("addChildBtnId").className = "btn btn-gradient-primary";
                document.getElementById("addChildId").className = "d-none";
            }
            document.getElementById('form').addEventListener("submit", function (event) {
                event.preventDefault()
                let url = "{{route('admin.children.create')}}";
                let name = document.getElementById("name").value;
                let surname = document.getElementById("surname").value;
                let birth_date = document.getElementById("birth_date").value;
                let gender = document.querySelector('input[name="gender"]:checked').value;
                let parent_id = document.getElementById("parent_id").value;
                let group_id = document.getElementById("group_id").value;
                let photo = document.getElementById("photo").files[0];
                let birth_certificate = document.getElementById("birth_certificate").files[0];
                let med_certificate = document.getElementById("med_certificate").files[0];
                let med_disability = document.getElementById("med_disability").files[0];
                let data = new FormData();
                data.append("name", name);
                data.append("surname", surname);
                data.append("birth_date", birth_date);
                data.append("gender", gender);
                data.append("parent_id", parent_id);
                data.append("group_id", group_id);
                data.append("photo", photo);
                data.append("birth_certificate", birth_certificate);
                data.append("med_certificate", med_certificate);
                data.append("med_disability", med_disability);
                fetch(url, {
                    method: 'POST',
                    body: data
                })
                    .then(res => res.json())
                    .then(data => {
                        cancelForm();
                        let table = document.getElementById('childTable');
                        let i = table.rows.length;
                        let row = table.insertRow(i);
                        row.insertCell(0).innerHTML = data.id;
                        row.insertCell(1).innerHTML = data.name;
                        row.insertCell(2).innerHTML = data.surname;
                        row.insertCell(3).innerHTML = data.group_id;
                        row.insertCell(4).innerHTML = `<div style="float: left; display: block; width: 30%;" class="text-center">` +
                            `<a href="`+ "children/show/" + data.id + `"><i class="fas fa-eye"></i></a> </div>` +
                            `<div style="float: left; display: block; width: 30%;" class="text-center">` +
                            `<a href="`+ "admin/children/edit/" + data.id + `" class="text-success"><i class="fas fa-pen"></i></a> </div>` +
                            `<div style="float: left; display: block; width: 30%;" class="text-center">` +
                            `<form action="`+ "admin/children/delete/" + data.id + `" method="POST"> @method("DELETE") @csrf` +
                            `<button title="delete" class="border-0 bg-transparent">`+
                            `<i title="delete" class="fas fa-trash text-danger" role="button"></i> </button> </form> </div>`;
                    })
                    .catch(error => console.log(error))
            })
        </script>
    </div>
@endsection
