
<!-- this blade included in video-row blade in frontend shared folder  -->
<div class="card" style="width: 20rem;">
    <a href="{{ route('frontend.video' , ['id' => $video->id]) }}" title="{{ $video->name }}">
        <!-- title in anchor (a) for search engine -->
        <img class="card-img-top" src="{{ url('uploads/'.$video->image) }}" alt="{{ $video->name }}" style="max-height: 160px">
    </a>
    <div class="card-body">
        <p class="card-text">
            <a href="{{ route('frontend.video' , ['id' => $video->id]) }}" title="{{ $video->name }}">
                <!-- $video parsing from HomeController -->
                {{ $video->name }}
            </a>
        </p>
        <small>{{ $video->created_at }}</small>
    </div>
</div>