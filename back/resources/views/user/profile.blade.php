@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('lang.user_profile')</h5>
                        <form id="form" method="POST" action="{{route('profile.update', auth()->user()->id)}}" onsubmit="" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img
                                    src="{{asset($user->profile_photo)}}"
                                    alt="user-avatar"
                                    class="d-block rounded img-fluid"
                                    height="100"
                                    width="100"
                                    id="uploadedAvatar"
                                />
                                <div class="">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <input
                                            type="file"
                                            id="profile_photo"
                                            name="profile_photo"
                                            class="account-file-input form-control"
                                        />
                                    </label>
                                    <p class="text-muted mb-0">@lang('lang.profile_photo_msg')</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name"  class="form-label">@lang('lang.name')</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="name"
                                            name="name"
                                            value="{{$user->name}}"
                                            autofocus
                                        />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="surname" class="form-label">@lang('lang.surname')</label>
                                        <input class="form-control" type="text" name="surname" id="surname" value="{{$user->surname}}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">@lang('lang.email')</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="email"
                                            name="email"
                                            value="{{$user->email}}"
                                            placeholder=""
                                        />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phone_number">@lang('lang.phone_number')</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                id="phone_number"
                                                name="phone_number"
                                                class="form-control"
                                                value="{{$user->phone_number}}"
                                                placeholder=""
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">@lang('lang.address')</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$user->address}}"/>
                                    </div>
                                    <div class="mb-3 col-md-6"></div>
                                    <div class="mb-3 col-md-6">
                                        <label for="passport_front" class="form-label">@lang('lang.passport_front')</label>
                                        <input type="file" class="form-control" id="passport_front" name="passport_front" placeholder="" value=""/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">@lang('lang.passport_back')</label>
                                        <input type="file" class="form-control" id="passport_back" name="passport_back" placeholder="" value=""/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <img class="img-fluid" src="{{asset($user->passport_front)}}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <img class="img-fluid" src="{{asset($user->passport_back)}}">
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary ms-auto">@lang('lang.save_btn')</button>
                                </div>
                        </div>
                        </form>
                    </div>

    </div>
@endsection
