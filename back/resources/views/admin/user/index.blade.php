@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
        <button type="button" class="btn btn-gradient-primary" style="margin-right:85%;" id="addUserBtnId" onclick="showForm()">@lang('lang.add_user')</button>
        <div class="d-none" id="addUserId">
            <form id="form" method="POST" action="{{route('admin.user.create')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">@lang('lang.name'):</label>
                    </div>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="surname" class="col-md-4 col-form-label text-md-end">@lang('lang.surname'):</label>
                    </div>

                    <div class="col-md-6">
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="address" class="col-md-10 col-form-label text-md-end">@lang('lang.address'):</label>
                    </div>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="phone_number" class="col-md-10 col-form-label text-md-end">@lang('lang.phone_number'):</label>
                    </div>
                    <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email" class="col-md-10 col-form-label text-md-end">@lang('lang.email'):</label>
                    </div>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="password" class="col-md-10 col-form-label text-md-end">@lang('lang.password'):</label>
                    </div>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="role" class="col-md-4 col-form-label text-md-end">@lang('lang.role'):</label>
                    </div>

                    <div class="col-md-6">
                        <select style="width: 50% !important;" name="role" id="role">
                            <option value="ROLE_ADMIN">Админ</option>
                            <option value="ROLE_TEACHER">@lang('lang.employee')</option>
                            <option value="ROLE_PARENT">@lang('lang.parent')</option>
                        </select>
                        @error('role')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="profile_photo" class="col-md-10 col-form-label text-md-end">@lang('lang.profile_photo'):</label>
                    </div>

                    <div class="col-md-6">
                        <input id="profile_photo" type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo" value="{{ old('profile_photo') }}">

                        @error('profile_photo')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-7">
                        <label for="passport_front" class="col-md-12 col-form-label text-md-end">@lang('lang.passport_front'):</label>
                    </div>
                    <div class="col-md-5">
                        <input id="passport_front" type="file" class="form-control @error('passport_front') is-invalid @enderror" name="passport_front" value="{{ old('passport_front') }}">

                        @error('passport_front')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-7">
                        <label for="passport_back" class="col-md-12 col-form-label text-md-end">@lang('lang.passport_back'):</label>
                    </div>

                    <div class="col-md-5">
                        <input id="passport_back" type="file" class="form-control @error('passport_back') is-invalid @enderror" name="passport_back" value="{{ old('passport_back') }}">

                        @error('passport_back')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <br>
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
                <h3>@lang('lang.users_list')</h3>
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
                            <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">
                                id
                            </th>
                            <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">
                                @lang('lang.name')
                            </th>
                            <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">
                                @lang('lang.surname')
                            </th>
                            <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:10%">
                                @lang('lang.role')
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
                            <th class=""><input class="form-control form-control-sm" value="" oninput="searchByRole(this.value)"></th>
                        </tr>
                        </thead>
                        <tbody id="userTable">
                        @foreach ($users as $user)
                            <tr class=>
                                <td class="">{{$user->id}}</td>
                                <td class="">{{$user->name}}</td>
                                <td class="">{{$user->surname}}</td>
                                <td class="">
                                    @if($user->role == 'ROLE_ADMIN')
                                        Админ
                                    @elseif($user->role == 'ROLE_TEACHER')
                                        @lang('lang.employee')
                                    @elseif($user->role == 'ROLE_PARENT')
                                        @lang('lang.parent')
                                    @else
                                        @lang('lang.user')
                                    @endif
                                </td>
                                <td>
                                    <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                        <a href="{{route('admin.user.show', $user)}}"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                        <a href="{{route('admin.user.edit', $user)}}" class="text-success"><i class="fas fa-pen"></i></a>
                                    </div>
                                    <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                        <form action="{{route('admin.user.delete', $user->id)}}" method="POST">
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
                let table = document.getElementById('userTable');
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
                let table = document.getElementById('userTable');
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
                let table = document.getElementById('userTable');
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
            function searchByRole(value){
                let table = document.getElementById('userTable');
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
                document.getElementById("addUserBtnId").className = "d-none";
                document.getElementById("addUserId").className = "col-12";
            }
            function cancelForm(){
                document.getElementById("addUserId").className = "d-none";
                document.getElementById("addUserBtnId").className = "btn btn-gradient-primary";
            }
            document.getElementById('form').addEventListener("submit", function (event) {
                event.preventDefault()
                let url = "{{route('admin.user.create')}}";
                let name = document.getElementById("name").value;
                let surname = document.getElementById("surname").value;
                let address = document.getElementById("address").value;
                let phone_number = document.getElementById("phone_number").value;
                let email = document.getElementById("email").value;
                let password = document.getElementById("password").value;
                let role = document.getElementById("role").value;
                let passport_front = document.getElementById("passport_front").files[0];
                let passport_back = document.getElementById("passport_back").files[0];
                let data = new FormData();
                data.append("name", name);
                data.append("surname", surname);
                data.append("address", address);
                data.append("phone_number", phone_number);
                data.append("email", email);
                data.append("password", password);
                data.append("role", role);
                data.append("passport_front", passport_front);
                data.append("passport_back", passport_back);
                fetch(url, {
                    method: 'POST',
                    body: data
                })
                    .then(res => res.json())
                    .then(data => {
                        cancelForm();
                        let table = document.getElementById('userTable');
                        let i = table.rows.length;
                        let row = table.insertRow(i);
                        row.insertCell(0).innerHTML = data.id;
                        row.insertCell(1).innerHTML = data.name;
                        row.insertCell(2).innerHTML = data.surname;
                        row.insertCell(3).innerHTML = data.role;
                        row.insertCell(4).innerHTML = `<div style="float: left; display: block; width: 30%;" class="text-center">` +
                            `<a href="`+ "admin/user/show" + data.id + `"><i class="fas fa-eye"></i></a> </div>` +
                        `<div style="float: left; display: block; width: 30%;" class="text-center">` +
                            `<a href="`+ "admin/user/edit" + data.id + `" class="text-success"><i class="fas fa-pen"></i></a> </div>` +
                        `<div style="float: left; display: block; width: 30%;" class="text-center">` +
                            `<form action="`+ "admin/user/delete" + data.id + `" method="POST"> @method("DELETE") @csrf` +
                                `<button title="submit" class="border-0 bg-transparent">`+
                                `<i title="submit" class="fas fa-trash text-danger" role="button"></i> </button> </form> </div>`;
                    })
                    .catch(error => console.log(error))
            })
        </script>
@endsection
