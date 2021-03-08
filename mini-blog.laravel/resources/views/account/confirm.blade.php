@extends('layouts.base')

@section('title', 'アカウント登録')

@section('menubar')
   @parent
   <button type="button" class="btn btn-secondary btn-sm mt-4 mb-2 ml-4" onclick=history.back()>登録画面に戻る</button>
@endsection

@section('description')
以下の内容で登録します。内容をご確認ください。
@endsection

@section('content')
<div class="container mb-5">
    <div class="p-5 mb-3 bg-light rounded">
        <form action="/account/register" method="post" class="confirm">
            @csrf
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="email" value="{{$email}}">
            <input type="hidden" name="password" value="{{$password}}">
            <div class="row mx-2 mt-2 mb-3">
                <div class="col-2 badge badge-success text-wrap">ユーザー名</div>
                <div class="col-10">{{$name}}</div>
            </div>
            <div class="row m-2">
                <div class="col-2 badge badge-success text-wrap">メールアドレス</div>
                <div class="col-10">{{$email}}</div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary m-4">登録</button>
        </form>
    </div>
</div>
@endsection
