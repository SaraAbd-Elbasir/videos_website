<!-- id="comments -> when update comment go to comment section redirect " -->
<div class="row" id="commnets">
    <div class="col-md-12">
        <div class="card text-left">
            <div class="card-header card-header-rose">
                @php $comments = $video->comments @endphp
                <h5>Comments ({{ count($comments) }})</h5>
            </div>
            <div class="card-body">
                @foreach($comments as $comment)
                    <div class="row">
                        <div class="col-md-8">
                            <i class="nc-icon nc-chat-33"></i> :
                            <!-- slug helper func -->
                            <a href="{{ route('front.profile' , ['id' => $comment->user->id , 'slug' => slug($comment->user->name)]) }}">
                                {{ $comment->user->name }}
                            </a>
                        </div>
                        <div class="col-md-4 text-right">
                                    <span>
                                        <i class="nc-icon nc-calendar-60"></i> : {{ $comment->created_at}} |
                                    </span>
                        </div>
                    </div>
                    <p>{{ $comment->comment }} </p>
                    @if(auth()->user())
                 <!-- if condition cause we want only can edit comment must be (admin or user who write comment) -->
                        @if((auth()->user()->group == 'admin') || auth()->user()->id == $comment->user->id )
                            <!-- return false to prevent reload page when press edit and show toggle -->
                            <a href="" onclick="$(this).next('div').slideToggle(1000);return false;">edit</a>
                            <div style="display: none">
                                <form action="{{route('front.commentUpdate' , ['id' =>$comment->id ])}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <textarea name="comment"  class="form-control"  rows="4">{{  $comment->comment }}</textarea>
                                    </div>
                                    <button type="submit" class="btn">Edit</button>
                                </form>
                            </div>
                        @endif
                    @endif
                    <!-- to put line under comment and if not last don't put line -->
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>