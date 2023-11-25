@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="bg-light rounded">
            <div class="row">
                <div class="wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100 d-flex flex-column justify-content-center p-5">
                        <h2 class="team-text text-center">@lang('lang.vac_msg')</h2>
                        <br>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="full_name" name="full_name" placeholder="Your Name">
                                        <label for="full_name">@lang('lang.full_name')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control border-0" id="phone_numberId" name="phone_number" placeholder="Your Email">
                                        <label for="phone_number">@lang('lang.phone_number')</label>
                                    </div>
                                </div>
                                <div id="answersElement">
                                    @foreach($questions as $question)
                                        <div class="col-12">
                                            <div class=""><p class="text-purple">{{$question->question}}</p></div>
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" data-question="{{$question->id}}" placeholder="Leave a message here" id="answers" name="answers" style="height: 100px" ></textarea>
                                                <label for="answers">@lang('lang.vac_reply')</label>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>

                                <div class="col-sm-6">
                                    <div class="field">
                                        <div class="team-text">
                                            <h4 class="">@lang('lang.vac_cv'):</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="field">
                                        <input type="file" class="form-control" id="resume" name="resume" placeholder="Your Resume">
                                        <label for="resume"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="button" onclick="saveResume()">@lang('lang.send_btn')</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let ob = {};
        function saveResume() {
            let url = "{{route('vacancy.save')}}";
            let full_name = document.getElementById("full_name").value;
            let phone_number = document.getElementById("phone_numberId").value;
            let resume = document.getElementById("resume").files[0];

            let answers = document.getElementById('answersElement').children;
            let n = answers.length
            for(let i = 0; i < n; i+= 2)
            {
                let e = answers[i].children[1].children[0];
                ob[e.dataset.question] = e.value;
            }
            let data = new FormData;
            data.append("resume", resume);
            data.append("full_name", full_name);
            data.append("phone_number", phone_number);
            data.append("answers", JSON.stringify(ob));

            fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                body:data,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Вы успешно все заполнили!');
                })
                .catch(error => console.log(error))
        }

    </script>
@endsection
