@extends('layouts.base')

@section('title', 'お気に入り投稿一覧')

@section('menubar')
   @parent
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account" role="button">アカウント情報</a>
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account/all" role="button">ユーザー一覧</a>
@endsection

@section('description')
{{$user->name}}さんのお気に入り投稿一覧です。
@endsection

@section('content')


<div class="favorites container mb-5">
    <div class="status p-5 mb-4 bg-light rounded">
        <h2 class="status-title mb-4">お気に入り</h2>
        @if (!empty($favorites))
        @if (!is_null($favorites[0]))
        <div class="card">
            @foreach($favorites as $favorite)
            <x-status :status="$favorite" link="/post/{{$favorite->id}}"/>
            @endforeach
        </div>
        <div class="pagination mt-5">
            {{ $favorites->links() }}
        </div>
        @else
        <p class="mb-2 ml-4">まだお気に入りがありません。</p>
        @endif
        @endif
    </div>
</div>

@endsection
