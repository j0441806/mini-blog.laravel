<div class="card-body img-thumbnail p-5">
    <div class="mb-2">
        <span class="name badge badge-success mr-2">
            <a href="/user/{{$reply->user_id}}" class="text-light">{{$reply->name}}</a>
        </span>
        <span class="date">
            <a href="/post/{{$post->id}}/reply/{{$reply->id}}">{{$reply->created_at}}</a>
        </span>
    </div>
    <div class="post">
        {{$reply->posts}}
    </div>
    @if (!is_null($reply->image))
    @if ($reply->image)
    <div class="image mt-3">
        <img class="d-block mx-auto" src="{{ Storage::url($reply->image) }}" width="70%">
    </div>
    @endif
    @endif
</div>


