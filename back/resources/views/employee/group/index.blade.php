@extends('layouts.employee_layout')

@section('content')
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <button type="submit" class="btn btn-gradient-primary" data-toggle="modal" data-target="#exampleModal">@lang('lang.add_child_btn')</button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center text-bold-400">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('lang.add_child_topic')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form" action="{{route('employee.group.create')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="card-content">
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_name')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" id="name" name="name" value="" required="" autofocus="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_surname')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" id="surname" name="surname" value="" required="" autofocus="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_birth_date')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="" required="" autofocus="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_gender')</p></label>
                                                            </div>
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
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_parent')</p></label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="parent_id" id="parent_id">
                                                                    <option></option>
                                                                    @foreach($parents as $parent)
                                                                    <option value="{{$parent->id}}">{{$parent->name}} {{$parent->surname}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row" hidden="">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">Название Группы</p></label>
                                                            </div>
                                                            <div class="col-lg-6" >
                                                                <select class="form-control" name="group_id" id="group_id">
                                                                    @foreach($groups as $group)
                                                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_photo')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control" id="photo" name="photo" value=""  autofocus="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_birth_cert')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control" id="birth_certificate" name="birth_certificate" value=""  autofocus="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_med_cert')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control" id="med_certificate" name="med_certificate" value=""  autofocus="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label> <p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.child_med_dis')</p></label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control" id="med_disability" name="med_disability" value=""  autofocus="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <div class="modal-footer">
                                    <div class="col-12 text-right">
                                        <button id="cancelBtn" class="btn btn-gradient-primary my-1" data-dismiss="modal">@lang('lang.close_btn')</button>
                                        <button type="submit" class="btn btn-gradient-secondary my-1 ">@lang('lang.saveBtn')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if (session('status'))
                <div class="alert alert-dismissible white" style="background-color: #9b73f2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status') }}
                </div>
            @endif
            <div class="position-relative table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:40%">
                            <div class="d-inline">Ф.И.О</div>
                        </th>
                        <th class="position-relative pr-5" style="vertical-align:middle;overflow:hidden;cursor:pointer">
                            <div class="d-inline">@lang('lang.child_birth_date')</div>
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">
                            <div class="d-inline">@lang('lang.child_parent')</div>
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:1%">
                            <div class="d-inline"></div>
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:1%">
                            <div class="d-inline">@lang('lang.func')</div>
                        </th>
                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:1%">
                            <div class="d-inline"></div>
                        </th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByBD(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByParent(this.value)"></th>
                    </tr>
                    </thead>
                    <tbody id="TableId">
                    @foreach($children as $child)
                        @if($child->deleted === 0)
                            <tr class="">
                                <td class="">{{$child->name}} {{$child->surname}}</td>
                                <td class="">{{$child->birth_date}}</td>
                                @foreach($parents as $parent)
                                    @if($child->parent_id === $parent->id)
                                        <td class="">{{$parent->name}} {{$parent->surname}}</td>
                                    @endif
                                @endforeach
                                <td class="py-1 px-1"><a href="{{route('employee.group.edit', $child->id)}}" class="mb-0 btn-sm btn btn-outline-info round">@lang('lang.edit_btn')</a></td>
                                <td class="py-1 px-1"><a href="{{route('employee.group.show', $child->id)}}" class="mb-0 btn-sm btn btn-outline-success round">@lang('lang.show_btn')</a></td>
                                <td class="py-1 px-1">
                                    <form action="{{route('employee.group.delete', $child->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" title="delete" class="mb-0 btn-sm btn btn-outline-danger round" onclick="deletedBtn(this)">
                                            @lang('lang.delete_btn')
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
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
        function searchByName(value){
            let table = document.getElementById('TableId');
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
        function searchByBD(value){
            let table = document.getElementById('TableId');
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
        function searchByParent(value){
            let table = document.getElementById('TableId');
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

        document.getElementById('form').addEventListener("submit", function (event) {
            event.preventDefault()
            document.getElementById('cancelBtn').click();
            let url = "{{route('employee.group.create')}}";
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
                    let table = document.getElementById('groupTableId');
                    let i = table.rows.length;
                    let row = table.insertRow(i);
                    row.insertCell(0).innerHTML = data.name +" "+ data.surname;
                    row.insertCell(1).innerHTML = data.birth_date;
                    row.insertCell(2).innerHTML = data.parent_id;
                    row.insertCell(3).innerHTML = `<a href="employee/group/edit/${data.id}" class="mb-0 btn-sm btn btn-outline-info round">Редактировать</a>`;
                    row.insertCell(4).innerHTML = `<a href="employee/group/show/${data.id}" class="mb-0 btn-sm btn btn-outline-success round">Посмотреть</a>`;
                    row.insertCell(5).innerHTML = `<form action="employee/group/delete/${data.id}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" title="delete" class="mb-0 btn-sm btn btn-outline-danger round" onclick="alert('Вы уверены, что хотите удалить данные этого ребенка?')">
                        Удалить
                    </button>
                </form>`;
                })
                .catch(error => console.log(error))
        })
    </script>
    </div>
@endsection
