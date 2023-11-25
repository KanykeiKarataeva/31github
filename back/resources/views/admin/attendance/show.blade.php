@extends('layouts.admin_layout')
@section('content')
    <style>
        .accordion {
            background-color: #4da3ff;
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
            background-color: #007bff;
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
            background-color: #e6f2ff;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            border-radius: 10px;
        }
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .container {
            display: block;
            position: relative;
            cursor: pointer;
            font-size: 20px;
            user-select: none;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: relative;
            top: 0;
            left: 0;
            height: 1.5em;
            width: 1.5em;
            background-color: #ccc;
            border-radius: 50%;
            transition: .4s;
        }



        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            box-shadow: none;
            background-color: limegreen;
            transform: rotateX(360deg);
        }

        .container input:checked ~ .checkmark:hover {
            box-shadow: 3px 3px 3px rgba(0,0,0,0.2);
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 0.7em;
            top: 0.4em;
            width: 0.25em;
            height: 0.5em;
            border: solid white;
            border-width: 0 0.15em 0.15em 0;
            box-shadow: 0.1em 0.1em 0em 0 rgba(0,0,0,0.3);
            transform: rotate(45deg);
        }
    </style>
    <div class="content-wrapper">
        <div class="container" style="margin-top: 10px;">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                @if($attendance != null)
                    @foreach($groups as $group)
                        <button class="accordion" >{{$group->name}}</button>
                        <div class="panel">
                            <div class="position-relative table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:40%">
                                            <div class="d-inline" style="font-size: 15px">Ф.И.О</div>
                                        </th>
                                        @foreach($attendance as $at)
                                            @if($at->group_id === $group->id)
                                                <th class="position-relative pr-4" style="vertical-align:middle;overflow:hidden;cursor:pointer">
                                                    <div class="d-inline" style="font-size: 15px">{{\Carbon\Carbon::parse($at->date)->format('m/d')}}</div>
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody id="TableId">
                                    @foreach($children as $child)
                                        @if($child->group_id === $group->id)
                                            <tr class="" data-child="{{$child->id}}" data-group_id="{{$child->group_id}}">
                                                <td class="" style="font-size:20px">{{$child->name}} {{$child->surname}}</td>
                                                @foreach($attendance as $at)
                                                    @if($at->group_id === $group->id)
                                                        @php
                                                            $data = json_decode($at->children, true);
                                                        @endphp
                                                        @if(array_key_exists($child->id, $data))
                                                            @if($data[$child->id])
                                                                <td class="py-1 px-2">
                                                                    <label class="container">
                                                                        <input type="checkbox" checked="checked" disabled>
                                                                        <div class="checkmark"></div>
                                                                    </label>
                                                                </td>
                                                            @else
                                                                <td class="py-1 px-2">
                                                                    <label class="container">
                                                                        <input type="checkbox" disabled>
                                                                        <div class="checkmark"></div>
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td class="py-1 px-2"><label class="container"></label></td>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @elseif($attendance === null)
                    <alert>@lang('lang.no_data_for_month')</alert>
                @endif
        </div>
        <div style="text-align: right">
            <a href="{{route('admin.attendance.index')}}" class="btn btn-gradient-primary" >@lang('lang.back_btn')</a>
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

            let acc = document.getElementsByClassName("accordion");
            let i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
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
