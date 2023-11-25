@extends('layouts.employee_layout')
@section('content')
    <style>
        .accordion {
            background-color: #9b73f2;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 20px;
            transition: 0.4s;
            border-radius: 10px;

        }

        .active, .accordion:hover {
            background-color: #5f1dea;
        }

        .accordion:after {
            content: '\002B';
            color: black;
            font-weight: bold;
            float: right;
            margin-left: 20px;
        }

        .active:after {
            content: "\2212";
        }

        .panel {
            padding: 0 18px;
            background-color: #eee8fd;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            border-radius: 10px;
        }
    </style>
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status') }}
                </div>
            @endif
            <button type="button" class="btn btn-gradient-primary" style="margin-right:85%;" id="addPaymentBtnId" onclick="showForm()">@lang('lang.add_payment')</button>
            <div class="d-none" id="addPaymentId">
                <form method="POST" action="{{route('employee.payment.create')}}">
                    @csrf
                    <div class="row mb-3">
                        <label for="child_id"><p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.full_name_child'): </p></label>
                        <div class="col-md-6">
                            <select class="form-control col-md-12" name="child_id" id="child_id" @error('child_id') is-invalid @enderror required autocomplete="child_id">
                                <option></option>
                                @foreach($children as $child)
                                    <option value="{{$child->id}}">{{$child->name}}  {{$child->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date_from"><p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.from') : </p></label>
                        <div class="col-md-6">
                            <input id="date_from" type="date" class="form-control @error('date_from') is-invalid @enderror" name="date_from"  required autocomplete="date_from">
                            @error('date_from')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date_to"><p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.to') : </p></label>
                        <div class="col-md-6">
                            <input id="date_to" type="date" class="form-control @error('date_to') is-invalid @enderror" name="date_to"  required autocomplete="date_to">
                            @error('date_to')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="payment_amount"><p class="text-bold-700 text-uppercase mb-0 violet" style="color: #5f1dea">@lang('lang.payment_amount') : </p></label>
                        <div class="col-md-6">
                            <input id="payment_amount" type="number" class="form-control @error('payment_amount') is-invalid @enderror" name="payment_amount" value="" required autocomplete="payment_amount" autofocus>
                            @error('payment_amount')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-12 text-right">
                        <button type="button" class="btn-gradient-primary my-1" onclick="cancelForm()">@lang('lang.cancel')</button>
                        <button type="submit" class="btn-gradient-secondary my-1">@lang('lang.saveBtn')</button>
                    </div>

                </form>
            </div>
            <br><br><br>
            @for($index = 0; $index <= 3; $index++)
                @php
                    $currentDate = \Carbon\Carbon::now()->format('m');
                    $characters = str_split($currentDate);
                    $characters[1] = $characters[1]-$index;
                    $currentDate = implode('', $characters);
                @endphp
                <button class="accordion" >{{\Carbon\Carbon::create(null, $currentDate, 1)->format('F')}}</button>
                <div class="panel">
                    <div class="position-relative table-responsive">
                        @php $range = \Carbon\Carbon::createFromDate(2023, $currentDate)->daysInMonth; @endphp
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:40%">
                                    <div class="d-inline" style="font-size: 15px">@lang('lang.full_name_child')</div>
                                </th>
                                @for($i = 1; $i <= $range; $i++)
                                    <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer">
                                        <div class="d-inline" style="font-size: 15px">{{$i}} </div>
                                    </th>
                                @endfor
                            </tr>
                            <tr class="table-sm">
                                <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                            </tr>
                            </thead>
                            <tbody id="TableId">
                            @foreach($children as $child)
                                <tr class="" data-child="{{$child->id}}" data-group_id="">
                                    <td class="" style="font-size:20px">{{$child->name}} {{$child->surname}}</td>
                                    @foreach($payment as $pay)
                                        @if($child->id === $pay->child_id)
                                            @for($i = 1; $i <= $range; $i++)
                                                @if('2023-'.$currentDate.'-'.str_pad($i, 2, '0', STR_PAD_LEFT) >= $pay->date_from && '2023-'.$currentDate.'-'.str_pad($i, 2, '0', STR_PAD_LEFT) <= $pay->date_to)
                                                    <td class="" style="font-size:20px; background-color: #009900"></td>
                                                @else
                                                    <td class="" style="font-size:20px; background-color: #990000"></td>
                                                @endif
                                            @endfor
                                        @endif
                                    @endforeach
                                    {{--                                <td class="" style="font-size:20px; background-color: #00bc8c"></td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            @endfor

        </div>
        <script>
            function searchByName(value){
                let table = document.getElementById('TableId');
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
            function showForm(){
                document.getElementById("addPaymentBtnId").className = "d-none";
                document.getElementById("addPaymentId").className = "col-6";
            }
            function cancelForm(){
                document.getElementById("addPaymentBtnId").className = "btn btn-gradient-primary";
                document.getElementById("addPaymentId").className = "d-none";
            }
            let acc = document.getElementsByClassName("accordion");
            let i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    let panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    }
                });
            }
        </script>
    </div>
@endsection
