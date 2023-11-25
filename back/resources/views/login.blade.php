@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Log In') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.auth') }}" >
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="" name="email" required autocomplete="email">

                                    @if(session('errorWithEmail'))
                                    <p class="text-danger">{{session('errorWithEmail')}}</p>
                                        <script>
                                            document.getElementById('email').value = "{{session('email')}}";
                                        </script>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autocomplete="new-password">

                                    @if(session('errorWithPassword'))
                                        <p class="text-danger">{{session('errorWithPassword')}}</p>
                                        <script>
                                            document.getElementById('email').value = "{{session('email')}}";
                                        </script>
                                    @endif
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <a href="{{route('reset.password.form')}}" class="float-end">Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
