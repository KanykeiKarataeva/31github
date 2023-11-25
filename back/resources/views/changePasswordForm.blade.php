@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('user.auth')}}" id="form" >
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" value="{{$email}}" name="email" required autocomplete="email" disabled>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirmPassword" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirmPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="confirmPassword" required autocomplete="confirmPassword">
                                    <p class="text-danger" id="noMatchError"></p>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('form').addEventListener("submit", (event) => {
            event.preventDefault()
            const password = document.getElementById('password').value
            const confirmPassword = document.getElementById('confirmPassword').value
            const email = document.getElementById('email').value
            console.log(password, confirmPassword, email);
            if(password === confirmPassword){
                let url = "{{route('update.password')}}";
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({email:email, password:password})
                })
                    .then(res => res.json())
                    .then(body => {
                        console.log(body)
                    })
                    .catch(error => console.log(error))
            }
            else{
                document.getElementById('noMatchError').innerHTML = " Is no match password";
            }

        })

    </script>
@endsection
