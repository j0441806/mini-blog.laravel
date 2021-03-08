@extends('layouts.base')

@section('title', 'ホーム')

@section('menubar')
   @parent
   
@endsection

@section('description')
ホーム画面です。あなたの投稿やフォローしている人の投稿が表示されます。
@endsection

@section('content')
<div class="submit container mb-5">
    <div class="p-5 mb-3 bg-success rounded">
        <h2 class="text-white mb-4">
            <a href="/user/{{$user->id}}">{{$user->name}}</a>さん、投稿をどうぞ。
        </h2>
        <x-submit action="/post" submit="送信"/>
    </div>
</div>
@if (!empty($statuses))
@if (!is_null($statuses[0]))
<div class="statuses container mb-5">
    <div class="p-5 mb-3 bg-light rounded">
        <h2 class="status-title mb-4">
            みんなの投稿
        </h2>
        <div class="card">
            @foreach($statuses as $status)
            <x-status link="/post/{{$status->id}}" :status="$status"/>
            @endforeach
        </div>
        <div class="pagination mt-5">
            {{ $statuses->links() }}
        </div>
    </div>
</div>
@endif
@endif
@endsection
