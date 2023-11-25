@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Email verification</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('verification') }}" >
                            @csrf
                            <div class="field">
                                <i class="icon fas fa-lock"></i>
                                <input type="text" id="code" name="code" placeholder="Enter a code:" class="login__input @error('code') is-invalid @enderror" required autocomplete="new-password">
                                @if(session('errorWithCode'))
                                    <p class="text-danger">{{session('errorWithCode')}}</p>
                                    <script>
                                        document.getElementById('code').value = "{{session('code')}}";
                                    </script>
                                @endif
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                            <input type="text" name="user" value="{{$user}}" hidden>
                            <input type="text" name="currentCode" value="{{session('code')}}" hidden>
                        </form>
{{--                        <form id="form">--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Enter a code:') }}</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input id="code" type="text" class="form-control @error('code incorrect') is-invalid @enderror" value="" name="code" required autocomplete="code">--}}

{{--                                        <p class="text-danger" id="verificationError"></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row mb-0">--}}
{{--                                <div class="col-md-6 offset-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        Register--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <script>--}}
{{--        function checkCode(code){--}}
{{--            if(code === "{{session('code')}}"){--}}
{{--                --}}
{{--            }--}}
{{--        }--}}
{{--        document.getElementById('form').addEventListener("submit", (event) => {--}}
{{--            event.preventDefault()--}}
{{--            const code = document.getElementById('code').value--}}
{{--            if(code === "{{session('code')}}"){--}}
{{--                let url = "{{route('verification')}}"--}}
{{--                fetch(url, {--}}
{{--                    method: 'POST',--}}
{{--                    headers: {--}}
{{--                        'Content-Type': 'application/json'--}}
{{--                    },--}}
{{--                    body: JSON.stringify({user:"{{$user}}"})--}}
{{--                })--}}
{{--                    .then(res => res.json())--}}
{{--                    .then(body => {--}}
{{--                        console.log(body)--}}

{{--                        location.href = "{{route('index', ['user' => $user])}}"--}}
{{--                    })--}}
{{--                    .catch(error => console.log(error))--}}
{{--            }--}}
{{--            else{--}}
{{--                document.getElementById('verificationError').innerHTML = "Incorrect code";--}}
{{--            }--}}

{{--        })--}}


{{--    </script>--}}
@endsection
