@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="card-header text-center" ><h3>@lang('lang.edit_btn')</h3></div>
        <div class="container">
            <form action="{{route('admin.children.update', $child->id)}}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.child_name'):</label>
                    <input type="text" class="form-control col-6" name="name" id="name" value="{{$child->name}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.child_surname'):</label>
                    <input type="text" class="form-control col-6" name="surname" id="surname" value="{{$child->surname}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('child')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.child_birth_date'):</label>
                    <input type="date" class="form-control col-6" name="birth_date" id="birth_date" value="{{$child->birth_date}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('birth_date')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.child_gender'):</label>
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
                    @error('birth_date')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.child_parent'):</label>
                    <select class="form-control col-md-12" name="parent_id" id="parent_id" @error('parent_id') is-invalid @enderror required autocomplete="parent_id">
                        @foreach($parents as $parent)
                            <option value="{{$parent->id}}" {{$parent->id === $child->parent_id ? "selected" : ""}}>{{$parent->name}}  {{$parent->surname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.child_group'):</label>
                    <select class="form-control col-md-12" name="group_id" id="group_id" @error('group_id') is-invalid @enderror required autocomplete="group_id">
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{$group->id === $child->group_id ? "selected" : ""}}>{{$group->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInput" class="form-label">@lang('lang.child_photo'):</label>
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="photo" id="photo">
                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInput" class="form-label">@lang('lang.child_birth_cert'):</label>
                        <input type="file" class="form-control" name="birth_certification" id="birth_certification">
                        @error('birth_certification')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInput" class="form-label">@lang('lang.child_med_cert'):</label>
                        <input type="file" class="form-control" name="med_certification" id="med_certification">
                        @error('med_certification')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInput" class="form-label">@lang('lang.child_med_dis'):</label>
                        <input type="file" class="form-control" name="med_disability" id="med_disability">
                        @error('med_disability')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.payment_btn'):</label>
                    <input type="number" class="form-control col-6" name="payment" id="payment" value="{{$child->payment}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('payment')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="modal-footer">
                    <a href="{{route('admin.children.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.cancel')</a>
                    <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.save_btn')</button>
                </div>
            </form>

        </div>
    </div>
@endsection
