@extends('layouts.base')

@section('title', 'ログイン')

@section('menubar')
   @parent
   <span class="text-muted">
        <a class="btn btn-success btn-sm my-3 mr-1 ml-4" href="/account/signup" role="button">新規登録</a>はこちらからどうぞ。
   </span>
@endsection

@section('description')
以下のフォームから、ログイン手続きをお願いいたします。
@endsection

@section('content')
<div class="container mb-5">
    <div class="p-5 mb-3 bg-light rounded">
        <form action="/account/auth" method="post" class="signin">
            @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">※入力に問題があります。再入力をお願いします。</div>
            @endif
            @csrf
            <div class="form-group">
                @error('email')
                    <div class="alert alert-warning" role="alert">{{$message}}</div>
                @enderror
                <label for="inputEmail">メールアドレス</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email address" name="email" value="{{$email}}">
            </div>
            <div class="form-group">
                @error('password')
                    <div class="alert alert-warning" role="alert">{{$message}}</div>
                @enderror
                <label for="inputPassword">パスワード</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password"name="password" value="{{old('password')}}">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="check" name="check" value="on">
                <label class="form-check-label" for="check">次回からは自動的にログインする</label>
            </div>
            <button type="submit" class="btn btn-lg btn-primary mt-2">ログイン</button>
        </form>
    </div>
</div>
@endsection
