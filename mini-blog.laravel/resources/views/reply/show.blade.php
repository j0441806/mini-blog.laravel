@extends('layouts.base')

@section('title', 'コメント詳細ページ')

@section('menubar')
   @parent
   <button type="button" class="btn btn-secondary btn-sm my-3 ml-4" onclick=history.back()>前のページに戻る</button>
@endsection

@section('description')
コメントの詳細情報とコメントへの返信が表示されます。
@endsection

@section('content')
<div class="container mb-3">
    <div class="reply p-5 mb-4 bg-light rounded">
        <!-- <x-status link="/post/{{$post->id}}/reply/{{$reply->id}}" :status="$status"/> -->
        <x-reply :reply="$status" :post="$post"/>

    </div>
</div>

<div class="container mb-3">
    <div class="comment p-5 mb-4 bg-info rounded">
        <h2 class="text-white mb-4">コメントする</h2>
        <x-submit action="/comment/post/{{$post->id}}/reply/{{$reply->id}}" submit="送信"/>
    </div>
</div>

@if (!empty($replies))
@if (!is_null($replies[0]))
<div class="container mb-5">
    <div class="replies p-5 mb-4 bg-light rounded">
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
@endif
@endif
@endsection
