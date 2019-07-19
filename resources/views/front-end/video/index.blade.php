@extends('layouts.app')

@section('title' , $video->name)

@section('meta_keywords' , $video->meta_keywords)

@section('meta_des' , $video->meta_des)

@section('content')
    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <!-- all video name title tag must be h1 for google archive -->
                <!-- $video parsing from HomeController (video function) -->
                <h1>{{ $video->name}}</h1>
            </div>
            <!-- for youtube video -->
            <div class="row">
                <div class="col-md-12">
                    <!-- cause only var parsing is $video from HomeController -->
                    @php $url = getYoutubeId($video->youtube) @endphp
                    @if($url)
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $url }}"
                                style="margin-bottom: 20px" frameborder="0" allowfullscreen></iframe>
                    @endif
                </div>
            </div>
            <!-- for video details -->
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span style="margin-right: 20px">
                            <i class="nc-icon nc-user-run"></i> : {{ $video->user->name }}
                        </span>
                        <span style="margin-right: 20px">
                            <i class="nc-icon nc-calendar-60"></i> :  {{ $video->created_at }}
                        </span>
                        <span style="margin-right: 20px">
                            <i class="nc-icon nc-single-copy-04"></i> :    <a
                                    href="{{ route('front.category' , ['id' => $video->cat->id ]) }}">
                            {{ $video->cat->name }}
                        </a>
                        </span>
                    </p>
                    <p>
                        {{ $video->des }}
                    </p>
                </div>
                <!-- for Tags -->
                <div class="col-md-3">
                    <h6>Tags</h6>
                    <p>
                        @foreach($video->tags as $tag)
                            <a href="{{ route('front.tags' , ['id' => $tag->id]) }}">
                                <span class="badge badge-pill badge-primary">{{ $tag->name }}</span>
                            </a>
                        @endforeach
                    </p>
                </div>
                <!-- for skills -->
                <div class="col-md-3">
                    <h6>Skills</h6>
                    <p>
                        @foreach($video->skills as $skill)
                            <a href="{{ route('front.skill' , ['id' => $skill->id]) }}">
                                <span class="badge badge-pill badge-info">{{ $skill->name }}</span>
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
            <br><br>
            @include('front-end.video.comments')
            @include('front-end.video.create-comment')
        </div>
    </div>
@endsection
