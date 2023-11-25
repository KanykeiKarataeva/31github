@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
            <div id="addChildId">
                <form method="POST" action="{{route('admin.attendance.show')}}">
                    @csrf
                    <div class="position-relative table-responsive" style="margin-top: 20px;"><h4>@lang('lang.select_month_to_view')</h4></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <input id="date" type="month" class="@error('date') is-invalid @enderror" name="date" value="{{date('Y-m')}}" style="margin: 20px 20px;" required autocomplete="date">
                            @error('date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-sm-2" style="flex: 50%; padding: 15px;width: 300px;">
                            <button type="submit" class="btn btn-gradient-primary" style="margin-right:85%;">@lang('lang.show_btn')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
