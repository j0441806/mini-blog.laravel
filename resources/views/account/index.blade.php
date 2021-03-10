@extends('layouts.base')

@section('title', 'アカウント情報')

@section('menubar')
   @parent
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/user/{{$user->id}}" role="button">{{$user->name}}さんの投稿一覧を見る</a>
@endsection

@section('description')
<div class="my-4 ml-4">
    <span>
        {{$message}}<a href="/user/{{$user->id}}">{{$user->name}}</a>さんのアカウント情報です。
    </span>
    <ul class="mt-3">
        <li>
            <a href="/account/profile" class="text-primary">自己紹介文を登録する</a>
        </li>
        <li>
            <a href="/account/image" class="text-primary">プロフィール画像を登録する</a>
        </li>
        <li>
            <a href="/account/favorites" class="text-primary">お気に入りの投稿を見る</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="account-info container mb-3">
    <div class="p-5 mb-4 bg-light rounded">
        <div class="row">
            <ul style="list-style: none;" class="col-7">
                <li class="mb-2"><i class="fas fa-user mr-3"></i><span class="font-weight-bold">ユーザーID： </span>{{$user->id}}</li>
                <li class="mb-2"><i class="fas fa-envelope mr-3"></i><span class="font-weight-bold">メールアドレス： </span>{{$user->email}}</li>
                <li class="mb-2"><i class="fas fa-calendar-day mr-3"></i><span class="font-weight-bold">登録日： </span>{{$user->created_at}}</li>
                <li class="mb-2"><i class="fas fa-address-card mr-3"></i><span class="font-weight-bold">自己紹介： </span>{{$user->description}}</li>
            </ul>
            @if (!is_null($user->image))
            @if ($user->image)
            <div class="image col-4 ml-3">
                <p class="mb-2"><i class="fas fa-address-card mr-3"></i><span class="font-weight-bold">プロフィール画像： </span></p>
                <img src="{{ Storage::url($user->image) }}" width="70%" class="img-thumbnail ml-2">
                <!-- <a href="/storage/img105.jpg">アップロードファイル</a> -->
            </div>
            @endif
            @endif
        </div>
    </div>
</div>

<div class="follow container mb-3">
    <div class="p-3 mb-3 bg-info rounded">
        <div class="following">
            @if(count($following_users) > 0)
            <p class="text-white font-weight-bold mb-2 ml-4">フォロー中</p>
            <ul style="list-style: none;">
                @foreach($following_users as $following_user)
                <li>
                    <a href="/user/{{$following_user->id}}" class="badge badge-light text-dark">{{$following_user->name}}</a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-white mb-2 ml-4">まだ誰もフォローしていません</p>
            @endif
        </div>
    </div>
</div>

<div class="follow container mb-3">
    <div class="p-3 mb-4 bg-info rounded">
        <div class="followed">
            @if(count($followed_users) > 0)
            <p class="text-white font-weight-bold mb-2 ml-4">フォローされています</p>
            <ul style="list-style: none;">
                @foreach($followed_users as $followed_user)
                <li>
                    <a href="/user/{{$followed_user->id}}" class="badge badge-light text-dark">{{$followed_user->name}}</a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-white mb-2 ml-4">まだフォローされていません</p>
            @endif
        </div>
    </div>
</div>

<div class="serch container mb-5">
    <div class="pb-5 pl-4 mb-4 bg-white rounded">
        <a class="btn btn-success" href="/account/all" role="button">ユーザーを探す</a>
    </div>
</div>
@endsection
