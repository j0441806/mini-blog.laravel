@extends('layouts.base')

@section('title', '投稿詳細')

@section('menubar')
   @parent
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/index" role="button">ホーム画面へ戻る</a>
@endsection

@section('description')
投稿の詳細情報と投稿へのコメントが表示されます。
@endsection

@section('content')
<div class="status container mb-3">
    <div class="status p-5 mb-4 bg-light rounded">
        <x-status :status="$status" link="/post/{{$status->id}}"/>
        @if (!is_null($is_favorite))
        @if ($is_favorite)
        <form action="/unfavor" method="post" class="unfavor">
            @csrf
            <input type="hidden" name="post_id" value="{{$status->id}}">
            <div class="text-right">
                <button type="submit" class="btn btn-warning my-3 mr-5">お気に入り解除</button>
            </div>
        </form>
        @endif
        @else
        <form action="/favor" method="post" class="favor">
            @csrf
            <input type="hidden" name="favorite_id" value="{{$status->id}}">
            <div class="text-right">
                <button type="submit" class="btn btn-primary my-3 mr-5"><i class="fas fa-star"></i>お気に入り登録</button>
            </div>
        </form>
        @endif
    </div>
</div>

<div class="status-response container mb-3">
    <div class="status p-5 mb-4 bg-info rounded">
        @if ($status->user_id === $user->id)
        <h2 class="edit text-white mb-4">投稿を編集する</h2>
        <x-submit action="/edit/{{$status->id}}" submit="送信"/>
        <a class="delete btn btn-danger mt-3" href="/delete/{{$status->id}}" role="button"><i class="fas fa-exclamation-triangle mr-1"></i>投稿を削除する</a>
        @else
        <h2 class="reply text-white mb-4">返信する</h2>
        <x-submit action="/reply/{{$status->id}}" submit="送信"/>
        @endif
    </div>
</div>

@if (!empty($replies))
@if (!is_null($replies[0]))
<div class="replies container mb-5">
    <div class="replies p-5 mb-4 bg-light rounded">
        <div class="replies">
            <h2 class="replies-title mb-4">コメント一覧</h2>
            <div class="replies card">
                @foreach($replies as $reply)
                <x-reply :reply="$reply" :post="$post"/>
                @endforeach
            </div>
            <div class="pagination mt-5">
                {{ $replies->links() }}
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
