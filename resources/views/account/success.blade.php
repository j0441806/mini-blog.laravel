@extends('layouts.base')

@section('title', 'ようこそ！')

@section('menubar')
   @parent
   <br>
@endsection

@section('description')
ご登録ありがとうございます。
@endsection

@section('content')
<div class="container mb-5">
    <div class="p-5 mb-3 bg-success rounded">
        <div class="message text-white">
            {{$message}}
        </div>
        <a href="/index" class="text-primary">こちらからトップページへどうぞ。</a>
    </div>
</div>
@endsection
