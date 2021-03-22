<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Following;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\postRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 投稿一覧
    public function index(Request $request)
    {
        // ログインユーザーの取得
        $user = Auth::user();
        // 投稿の取得
        // $statuses = Post::leftJoin('users', 'posts.user_id', '=', 'users.id')
        // ->select('posts.*', 'users.name')
        // // ->get();
        // ->simplePaginate(5);

        // ログインユーザーとフォローユーザーの投稿を取得
        $statuses = Post::leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('followings', 'posts.user_id', '=', 'followings.following_id')
        ->where('users.id', $user->id)
        ->orWhere('followings.user_id', $user->id)
        ->select('posts.*', 'users.name')
        ->orderby('posts.created_at', 'desc')
        ->simplePaginate(5);
        
        return view('post.index', ['user' => $user, 'statuses' => $statuses]);
    }

    // 投稿処理
    public function create(postRequest $request)
    {
        $user = Auth::user();

        // $this->validate($request, Post::$rules);
        $post = new Post;
        $post->posts = $request->posts;
        $post->user_id = $user->id;
        // is_replyに0を設定
        // $post->is_reply = 0;

        // 画像の保存
        if ($request->image){
            // 元のファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            $modified_name = date("YmdHis") . '_' . $file_name;
            // dd($modified_name);
            
            $post->image = $request->image->storeAs('public', $modified_name);
        } else {
            // 
        }

        $post->save();

        return redirect('/index');
    }

    // 各ユーザーの投稿一覧
    public function user(User $user)
    {
        // ユーザー名を取得
        // $name = $user->name;

        // ユーザーIDから投稿を取得
        $statuses = Post::where('posts.user_id', $user->id)->simplePaginate(5);

        // フォローの判定
        $following = null;
        if (Auth::check()) {
            $me = Auth::user();
            // ログインユーザーのページでない場合
            // ログインユーザーがフォローしているユーザーを取得
            if ($me->id !== $user->id) {
                $following = Following::where('user_id', $me->id)
                    ->where('following_id', $user->id)
                    ->first();
            }
        }

        return view('/post/user', [
            // 'name' => $name,
            'user' => $user,
            'statuses' => $statuses,
            'following' => $following,
            'me' => $me,
            ]);
    }

    // 投稿詳細
    public function show(Post $post)
    {
        // ログインユーザー
        $user = Auth::user();

        $status = Post::select('posts.*', 'users.name')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $post->id)
            ->first();

        // 返信の取得
        $replies = Reply::select('replies.*', 'users.name')
        ->leftJoin('users', 'replies.user_id', '=', 'users.id')
        ->where('replies.post_id', $post->id)
        ->orderby('replies.created_at', 'desc')
        // ->get();
        ->simplePaginate(5);

        $is_favorite = Favorite::where('user_id', $user->id)
        ->where('post_id', $post->id)
        ->first();

       return view('/post/show', [
           'user' => $user,
           'post' => $post,
           'status' => $status,
           'replies' => $replies,
           'is_favorite' => $is_favorite,
           ]);
    }

    // 編集
    public function edit(postRequest $request, Post $post)
    {
        // $this->validate($request, Post::$rules);
        $item = $request->posts;
        $id = $post->id;

        Post::where('id', $id)
            ->update(['posts' => $item]);

        return redirect("post/$id");
    }

    // 削除
    public function delete(Post $post)
    {
        Post::destroy($post->id);

        return redirect('/index');
    }

    // お気に入り登録
    public function favor(Request $request)
    {
        $favorite_id = $request->favorite_id;
        if (!$favorite_id) {
            $msg = '投稿データの送信に失敗しました。';
            return view('account.error', ['message' => $msg]);
        }

        // お気に入り投稿の取得
        $favorite_post = Post::where('id', $favorite_id)->first();
        if (!$favorite_post) {
            $msg = '投稿データの取得に失敗しました。';
            return view('account.error', ['message' => $msg]);
        }

        // ログインユーザーの取得
        $user = Auth::user();

        // 既にフォロー済みでないかをチェック
        $is_favor = false;
        $cnt_favorite = Favorite::where('user_id', $user->id)
            ->where('post_id', $favorite_post->id)
            ->count('post_id');

        // お気に入り登録済みの場合
        if ($cnt_favorite !== 0) {
            $is_favor = true;
            $msg = 'すでにお気に入り登録済みです。';
            return view('account.error', ['message' => $msg]);
        }

        // お気に入り登録済みでない場合
        if (!$is_favor)
        {
            $favorite = new Favorite;
            $favorite->user_id = $user->id;
            $favorite->post_id = $favorite_post->id;
            $favorite->save();
        }

        return redirect("/post/$favorite_id");
    }

    // お気に入り解除
    public function unfavor(Request $request)
    {
        $user = Auth::user();
        
        Favorite::where('user_id', $user->id)
            ->where('post_id', $request->post_id)
            ->delete();

        return redirect("/post/$request->post_id");
    }

}
