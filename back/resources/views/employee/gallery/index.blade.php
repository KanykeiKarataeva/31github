@php use Carbon\Carbon; @endphp
@extends('layouts.employee_layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <div class="container">
        <button type="button" class="btn btn-gradient-primary m-3" id="addGalleryBtn" onclick="showChildInfo()">@lang('lang.add_btn')</button>
        <div class="d-none" id="addGallery">
            <form action="{{route('employee.gallery.create', $group_id[0]->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="files" class="col-md-4 col-form-label text-md-end">@lang('lang.add_image'):</label>
                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control" accept="image/*" name="images[]"multiple>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile" class="col-md-4 col-form-label text-md-end">@lang('lang.add_video'):</label>
                    <div class="col-md-6">
                        <input id="video" type="file" class="form-control" accept="video/*" name="videos[]" multiple>

                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile" class="col-md-4 col-form-label text-md-end">@lang('lang.add_info'):</label>
                    <div class="col-md-6">
                        <textarea
                            id="info"
                            name="info"
                            rows="5"
                            cols="40"
                            placeholder="@lang('lang.add_info_plh')"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-primary"
                            onclick="hideChildInfo()">@lang('lang.close_btn')
                    </button>
                    <button type="submit" class="btn btn-gradient-secondary m-3">@lang('lang.saveBtn')</button>
                </div>
            </form>
        </div>
        @if (session('status'))
            <div class="alert alert-dismissible white" style="background-color: #9b73f2">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
        @endif
            @if(count($galleries) != 0)
                <div class="card-body">
                    @php $index = 0; @endphp
                    @foreach($created_at_dates as $created_at_date)
                        <div class="card-header rounded-top" style="background-color: #cdb9f8; color: #000000">
                            <form action="{{route('employee.gallery.delete', $created_at_date)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                {{ Carbon::parse($created_at_date)->format('d/m/Y')}}
                                <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                    <i title="delete" class="fas fa-trash text-danger" role="button" style="font-size: 20px; font-weight: bold;"></i>
                                </button>
                            </form>
                        </div>
                        <div class="card-body" style="background-color: #eee8fd; display: flex; align-items: center; justify-content: center">
                            @php $j = 0; @endphp
                            <div id="carouselExampleIndicators{{$index}}" class="carousel slide" data-ride="carousel">
                                @if($count[$index] > 1)
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        @for($i =1 ; $i < $count[$index]; $i++)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                                        @endfor
                                    </ol>
                                @endif
                                <div class="carousel-inner" style="max-width: 500px; overflow: hidden">
                                    @foreach($galleries as $gallery)
                                        @if($created_at_date === $gallery->created_at)
                                            @if($gallery->video === null)
                                                @if($j === 0)
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src="{{asset($gallery->image)}}" >
                                                    </div>
                                                    @php $j++; @endphp
                                                @else
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="{{asset($gallery->image)}}" alt="Second slide">
                                                    </div>
                                                @endif
                                            @else
                                                @if($j === 0)
                                                    <div class="carousel-item active">
                                                        <video class="d-block w-100" controls >
                                                            <source src="{{asset($gallery->video)}}">.
                                                        </video>
                                                    </div>
                                                    @php $j++; @endphp
                                                @else
                                                    <div class="carousel-item">
                                                        <video class="d-block w-100" controls >
                                                            <source src="{{asset($gallery->video)}}">.
                                                        </video>
                                                    </div>
                                                @endif
                                            @endif
                                            @php $text = $gallery->info @endphp
                                        @endif
                                    @endforeach
                                </div>
                                @if($count[$index] > 1)
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators{{$index}}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators{{$index}}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body rounded-bottom" style="background-color: #eee8fd">
                            <h6>{{$text}}</h6>
                        </div>
                        <br>
                        @php $index++; $text = ""; @endphp
                    @endforeach
                </div>
            @else
                <p>@lang('lang.group_gallery_no_data')</p>
            @endif

    <script>
        function showChildInfo() {
            document.getElementById("addGallery").className = "container-xxl flex-grow-1 container-p-y";
            document.getElementById("addGalleryBtn").className = "d-none";
        }

        function hideChildInfo() {
            document.getElementById("addGallery").className = "d-none";
            document.getElementById("addGalleryBtn").className = "btn btn-gradient-primary m-3";
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
            <script>
                function deletedBtn(button){
                    let text = "@lang('lang.delete_question_group')";
                    if (confirm(text) === true) {
                        button.setAttribute('type', 'submit');
                    } else {
                        button.setAttribute('type', 'button');
                    }
                }
            </script>
@endsection
