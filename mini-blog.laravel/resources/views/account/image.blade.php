@extends('layouts.base')

@section('title', 'プロフィール画像登録')

@section('menubar')
   @parent
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account" role="button">アカウント情報</a>
@endsection

@section('description')
プロフィール画像登録画面です。
@endsection

@section('content')
<div class="container mb-5">
    <div class="p-5 mb-4 bg-info rounded">
        <form action="/account/image" enctype="multipart/form-data" method="post">
            @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">※画像登録に問題があります。再登録をお願いします。</div>
            @endif
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            @error('image')
            <div class="alert alert-warning" role="alert">{{$message}}</div>
            @enderror
            <p class="text-white">
                {{$user->name}}さん、プロフィール画像を選択してください。
            </p>
            <div class="form-group">
                <label for="inputProfileImage" class="text-white">プロフィール画像</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputProfileImage" name="image">
                    <label class="custom-file-label" for="inputProfileImage" data-browse="参照">ファイルを選択(ここにドロップすることもできます)</label>
                </div>
            </div>
            <hr/>
            <button type="submit" class="btn btn-lg btn-primary">登録</button>
        </form>
   </div>
</div>
@endsection
