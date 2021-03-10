@extends('layouts.base')

@section('title', 'エラー')

@section('menubar')
   @parent
  <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account/signin" role="button">ログイン</a>
@endsection

@section('description')
{{$message}}
@endsection

@section('content')

@endsection
