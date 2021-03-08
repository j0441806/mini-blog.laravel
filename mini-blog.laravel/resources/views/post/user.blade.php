@extends('layouts.base')

@section('title', 'ユーザー情報')

@section('menubar')
   @parent
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account" role="button">アカウント情報</a>
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account/all" role="button">ユーザー一覧</a>
@endsection

@section('description')
{{$user->name}}さんの投稿一覧です。
@endsection

@section('content')
<div class="follow container mb-3">
    @if ($user->id !== $me->id)
    <div class="p-3 mb-4 bg-info rounded">
    @if (!is_null($following))
    @if ($following)
        <p class="text-white font-weight-bold mb-2 ml-4">{{$user->name}}さんをフォローしています</p>
        <form action="/unfollow" method="post" class="unfollowing">
            @csrf
            <input type="hidden" name="unfollowing_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-warning my-2 ml-4">フォロー解除</button>
        </form>
    @endif
    @else
        <p class="text-white font-weight-bold mb-2 ml-4">{{$user->name}}さんをフォローする</p>
        <form action="/follow" method="post" class="following">
            @csrf
            <input type="hidden" name="following_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-primary my-2 ml-4">フォローする</button>
        </form>
    @endif
    </div>
    @endif
</div>

@if (!empty($statuses))
@if (!is_null($statuses[0]))
<div class="statuses container mb-5">
    <div class="status p-5 mb-4 bg-light rounded">
        <div class="card">
            @foreach($statuses as $status)
            <x-status :status="$status" link="/post/{{$status->id}}"/>
            @endforeach
        </div>
        <div class="pagination mt-5">
            {{ $statuses->links() }}
        </div>
</div>
@endif
@endif
@endsection
