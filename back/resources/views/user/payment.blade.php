@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-dismissible white" style="background-color: #9b73f2">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
        @endif
        <div class="container-xxl flex-grow-1 container-p-y" id="payment">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('lang.emp_payment')</h5>
                        <div class="card-body">
                            <h6>Пожалуйста проверьте нижеприведенные данные.</h6>
                            <br>
                            <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <h6 for="name" class="form-label"><b>Имя ребенка:</b></h6>
                                        <div class="text-secondary">{{$child[0]->name}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="surname" class="form-label"><b>Фамилия ребенка:</b></h6>
                                        <div class="text-secondary">{{$child[0]->surname}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 class="form-label" for="group_name"><b>Название группы:</b></h6>
                                        <div class="text-secondary">{{$child[0]->group_name}}</div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h6 for="parent_name" class="form-label"><b>Ваше имя:</b></h6>
                                        <div
                                            class="text-secondary">{{auth()->user()->name}} {{auth()->user()->surname}}</div>
                                    </div>
                            </div>
                            <br>
                            <h6>Стоимость будет рассчитана в соответствии с выбранными вами датами</h6>
                            <form id="form" action="{{route('payment.form')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="field" hidden="">
                                    <i class="icon fas fa-user"></i>
                                    <input type="text" id="child_id" value="{{$child[0]->id}}" name="child_id" placeholder="child_id" class="login__input @error('child_id') is-invalid @enderror" required autocomplete="child_id">
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <p for="date_from" class="form-label"><b>С какого числа:</b></p>
                                        <input id="date_from" type="date" class="form-control @error('date_from') is-invalid @enderror" name="date_from" value="{{ old('date_from') }}" required autofocus oninvalid="this.setCustomValidity('Please fill in the field')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <p for="date_to" class="form-label"><b>До какой:</b></p>
                                        <input id="date_to" type="date" class="form-control @error('date_to') is-invalid @enderror" name="date_to" value="{{ old('date_to') }}" required autofocus oninvalid="this.setCustomValidity('Please fill in the field')" oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary ms-auto float-end rounded-pill">Далее
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    </div>
@endsection
