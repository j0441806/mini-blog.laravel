@extends('layouts.base')

@section('title', 'アカウント登録')

@section('menubar')
    @parent
    <div class="text-muted my-4 ml-4">
        <p class="mb-2">
            既に登録されていますか？
        </p>
        <span>
            <a class="btn btn-success btn-sm  mr-1" href="/account/signin" role="button">ログイン</a>はこちらからどうぞ。
        </span>
    </div>
@endsection

@section('description')
新規アカウント登録をご希望の方は、以下のフォームよりご登録下さい。
@endsection

@section('content')

<div class="container mb-5">
    <div class="p-5 mb-3 bg-light rounded">
        <form action="/account/confirm" method="post" class="signup">
            @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">※入力に問題があります。再入力をお願いします。</div>
            @endif
            @csrf
            <div class="form-group">
                @error('name')
                    <div class="alert alert-warning" role="alert">{{$message}}</div>
                @enderror
                <label for="inputName">ユーザーID</label>
                <input type="text" class="form-control" id="inputName" placeholder="User Name" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                @error('email')
                    <div class="alert alert-warning" role="alert">{{$message}}</div>
                @enderror
                <label for="inputEmail">メールアドレス</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email address" name="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                @error('password')
                    <div class="alert alert-warning" role="alert">{{$message}}</div>
                @enderror
                <label for="inputPassword">パスワード</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password"name="password" value="{{old('password')}}">
            </div>
            <div class="form-group">
                @error('password_confirmation')
                <div class="alert alert-warning" role="alert">{{$message}}</div>
                @endif
                <label for="inputPasswordConfirmation">パスワード（確認）</label>
                <input type="password" class="form-control" id="inputPasswordConfirmation" placeholder="Password (Confirmation)"name="password_confirmation" value="{{old('password_confirmation')}}">
            </div>
            <button type="submit" class="btn btn-lg btn-primary mt-2">登録</button>
        </form>
    </div>
</div>
@endsection
