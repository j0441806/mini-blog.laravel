<div class="card-body img-thumbnail p-5">
    <div class="mb-2">
        @if ($status->name)
        <span class="name badge badge-success mr-2">
            <a href="/user/{{$status->user_id}}" class="text-light">{{$status->name}}</a>
        </span>
        @endif
        <span class="date">
            <a href="{{$link}}">{{$status->created_at}}</a>
            @if ($status->is_reply !== 0)
            <span><i class="fas fa-comment-dots ml-1"></i></sapn>
            @endif
        </span>
    </div>
        <div class="post">
            {{$status->posts}}
        </div>
        @if (!is_null($status->image))
        @if ($status->image)
        <div class="image mt-3">
            <img class="d-block mx-auto" src="{{ Storage::url($status->image) }}" width="70%">
        </div>
        @endif
        @endif
</div>
