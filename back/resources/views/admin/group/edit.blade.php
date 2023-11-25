@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="card-header text-center" ><h3>@lang('lang.edit_btn')</h3></div>
        <div class="container">
            <form action="{{route('admin.group.update', $group->id)}}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.emp_group_name'):</label>
                    <input type="text" class="form-control col-6" name="name" id="name" value="{{$group->name}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.teacher'):</label>
                    <select class="form-control col-6" name="teacher_id" id="teacher_id" @error('teacher_id') is-invalid @enderror required autocomplete="teacher_id">
                        <option></option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}" {{$teacher->id === $group->teacher_id ? "selected" : ""}}>{{$teacher->name}} {{$teacher->surname}}</option>
                        @endforeach
                    </select>                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.limit'):</label>
                    <input type="number" class="form-control col-6" name="limit" id="limit" value="{{$group->limit}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('limit')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput" class="form-label">@lang('lang.description'):</label>
                    <input type="text" rows="5" class="form-control col-6" name="description" id="description" value="{{$group->description}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                    @error('description')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile" class="col-md-4 col-form-label text-md-end">@lang('lang.group_image'):</label>
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="{{asset($group->image)}}"  alt="image" style="width:100%;">
                    </div>

                    <div class="col-md-6">
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="image" id="image">

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('admin.group.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.cancel')</a>
                    <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.save_btn')<</button>
                </div>
            </form>

        </div>
    </div>
@endsection
