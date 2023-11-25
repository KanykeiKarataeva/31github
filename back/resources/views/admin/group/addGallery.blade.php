@extends('layouts.admin_layout')
@section('content')
    <link rel="stylesheet" href="{{asset('style/group_gallery_style.css')}}">
    <div>
        @if(session('msg'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-success alert-dismissible fade show text-center" style="width:25%;">{{session('msg')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        @endif
    </div>
    <div class="content-wrapper">
        <div class="card-header text-center" ><h3>@lang('lang.gallery_of_group')</h3><strong>"{{$group->name}}"</strong></div>
        <div class="container">
            <form action="{{route('admin.gallery.create', $group->id)}}" method="POST" enctype="multipart/form-data">
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
                            cols="58"
                            placeholder="@lang('lang.add_info_plh')"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('admin.group.index')}}" class="btn btn-gradient-primary my-1">@lang('lang.cancel')</a>
                    <button type="submit" class="btn btn-gradient-secondary my-1">@lang('lang.saveBtn')</button>
                </div>
            </form>

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        @foreach($galleries as $gallery)
                        <li class="list-group-item">
                            <small>{{ Carbon\Carbon::parse($gallery->created_at)->format('d/m/Y')}}</small>
                            <h5 class="">{{$gallery->info}}</h5>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row">
                @php
                    $i = 1;
                @endphp
                @foreach($galleries as $gallery)
                    <div class="column" >
                    @if($gallery->image==null)
                            <video width="280" height="200" controls onclick="openModal();currentSlide({{$i}})" class="hover-shadow cursor">
                                <source src="{{asset($gallery->video)}}" type="video/mp4">.
                            </video>
                    @else
                            <img src="{{asset($gallery->image)}}" style="width:280px; height:200px" onclick="openModal();currentSlide({{$i}})" class="hover-shadow cursor">
                    @endif
                    @php
                        $i = $i + 1;
                    @endphp
                    </div>
                @endforeach
            </div>


            <div id="myModal" class="modal">
                <div class="modal-content" style="background-color: transparent">
                    <span class="close cursor" onclick="closeModal()">&times;</span>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($galleries as $gallery)
                        <div class="mySlides">
                            <form onclick="return confirm('Do you really want to delete?')" action="{{route('admin.gallery.delete', $gallery->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button title="submit" class="border-0 bg-transparent">
                                    <i title="delete" class="fas fa-trash text-danger" role="button" style="color: white; position: absolute; top: 65px; right: 20px; font-size: 20px; font-weight: bold;"></i>
                                </button>
                            </form>
                            <div class="numbertext">{{$i}} / {{$group->gallery->count()}}</div>
                            @if($gallery->image==null)
                                <video style="height: 100%" controls >
                                    <source src="{{asset($gallery->video)}}" type="video/mp4">.
                                </video>
                            @else
                                <img src="{{asset($gallery->image)}}" style="height: 100%">
                            @endif
                            @php
                                $i = $i + 1;
                            @endphp
                        </div>
                    @endforeach
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    <div class="caption-container">
                        <p id="caption"></p>
                    </div>


                    <div class="row">
                        @php
                            $i = 1;
                        @endphp
                        @foreach($galleries as $gallery)
                            <div class="column">
                                @if($gallery->image==null)
                                    <video class="demo cursor" style="width:100%" onclick="currentSlide({{$i}})" alt="{{$gallery->created_at}}" controls >
                                        <source src="{{asset($gallery->video)}}" type="video/mp4">.
                                    </video>
                                @else
                                    <img class="demo cursor" src="{{asset($gallery->image)}}" style="width:100%" onclick="currentSlide({{$i}})" alt="{{$gallery->created_at}}" >
                                @endif
                            @php
                                $i = $i + 1;
                            @endphp
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <script>
                function openModal() {
                    document.getElementById("myModal").style.display = "block";
                }

                function closeModal() {
                    document.getElementById("myModal").style.display = "none";
                }

                let slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("demo");
                    let captionText = document.getElementById("caption");
                    if (n > slides.length) {slideIndex = 1}
                    if (n < 1) {slideIndex = slides.length}
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active";
                    captionText.innerHTML = dots[slideIndex-1].alt;
                }

                let prev = document.getElementsByClassName("prev");
                let next = document.getElementsByClassName("next");

                prev.addEventListener("keydown", plusSlides(-1));
                next.addEventListener("keydown", plusSlides(1));
            </script>

            {{--        <script>--}}
{{--            document.getElementById('form').addEventListener("submit", function (event) {--}}
{{--                event.preventDefault()--}}
{{--                let data = new FormData();--}}
{{--                let url = "{{route('admin.gallery.create')}}";--}}
{{--                let groupId = document.getElementById("groupId").value;--}}
{{--                let nameGroup = document.getElementById("nameGroup").value;--}}
{{--                let images = [];--}}
{{--                let videos = [];--}}
{{--                let image_array = document.getElementById("image").files;--}}
{{--                let video_array = document.getElementById("video").files;--}}

{{--                data.append("groupId", groupId);--}}
{{--                data.append("nameGroup", nameGroup);--}}
{{--                console.log(data);--}}
{{--                for(image of image_array){--}}
{{--                    images.push(image);--}}
{{--                }--}}
{{--                images.forEach((image, i) => {--}}
{{--                    data.append('image'+i, image);--}}
{{--                })--}}
{{--                for(video of video_array){--}}
{{--                    videos.push(image);--}}
{{--                }--}}
{{--                images.forEach((video, i) => {--}}
{{--                    data.append('video'+i, video);--}}
{{--                })--}}

{{--                fetch(url, {--}}
{{--                    method: 'POST',--}}
{{--                    body: data--}}
{{--                })--}}
{{--                    .then(res => res.json())--}}
{{--                    .then(data => console.log(data))--}}
{{--                    .catch(error => console.log(error))--}}
{{--            })--}}
{{--        </script>--}}
    </div>
@endsection
