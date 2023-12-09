@extends('layouts.admin_layout')
@section('content')
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
