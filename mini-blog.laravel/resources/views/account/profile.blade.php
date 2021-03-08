@extends('layouts.base')

@section('title', 'プロフィール登録')

@section('menubar')
   @parent
   <button type="button" class="btn btn-secondary btn-sm my-3 ml-4" onclick=history.back()>前のページに戻る</button>
@endsection

@section('description')
プロフィール登録画面です。
@endsection

@section('content')
<div class="container mb-5">
   <div class="p-5 mb-4 bg-info rounded">
        <form action="/account/profile" method="post" class="profile">
            @if (count($errors) > 0)
            <div class="error_msg">
                <div class="alert alert-danger" role="alert">※入力に問題があります。再入力をお願いします。</div>
            </div>
            @endif
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            @error('description')
            <div class="alert alert-warning" role="alert">{{$message}}</div>
            @enderror
            <p class="text-white">
                {{$user->name}}さん、プロフィールを入力してください。
            </p>
            <div class="form-group">
                <label for="inputProfile" class="text-white">プロフィール文</label>
                <textarea class="form-control" id="inputProfile" placeholder="Please input text." name="description" value="{{old('description')}}" rows="3"></textarea>
            </div>
            <hr/>
            <button type="submit" class="btn btn-lg btn-primary">送信</button>
        </form>
   </div>
</div>
@endsection
