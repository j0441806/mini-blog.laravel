@extends('layouts.base')

@section('title', 'ユーザー一覧')

@section('menubar')
   @parent
   <a class="btn btn-secondary btn-sm my-3 ml-4" href="/account" role="button">アカウント情報</a>
@endsection

@section('description')
登録ユーザー一覧画面です。
@endsection

@section('content')
<div class="users-status container mb-5">
   <div class="p-5 mb-4 bg-info rounded">
        <div class="row">
        @foreach($users as $user)
        <div class="col-lg-4 col-sm-6 mb-3">
            <div class="img-thumbnail">
                @if (!is_null($user->image))
                @if ($user->image)
                <span class="image">
                    <img src="{{ Storage::url($user->image) }}" width="50px">
                </span>
                @endif
                @endif
                <a href="/user/{{$user->id}}" class="name badge badge-pill badge-secondary m-2">{{$user->name}}</a>
                <div class="description mt-1">
                    {{$user->description}}
                </div>
            </div>
            </div>
            @endforeach
        </div>
        <div class="pagination mt-5">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
