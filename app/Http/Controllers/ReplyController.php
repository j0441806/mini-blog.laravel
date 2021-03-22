<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Requests\replyRequest;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    // 返信
    public function reply(replyRequest $request, Post $post)
    {
        $user = Auth::user();

        // $this->validate($request, Reply::$rules);
        $reply = new Reply;
        $reply->posts = $request->posts;
        $reply->user_id = $user->id;
        $reply->post_id = $post->id;
        // reply_idに0を設定
        $reply->reply_id = '0';

        // postsテーブルのis_replyに1を設定
        Post::where('id', $post->id)
        ->update(['is_reply' => 1]);

        // 画像の保存
        if($request->image){
            $file_name = $request->file('image')->getClientOriginalName();
            $reply->image = $request->file('image')->storeAs('public', $file_name);
        }

        $reply->save();

        return redirect("/post/$post->id");
    }

    // 返信詳細
    public function show(Post $post, Reply $reply)
    {
        $status = Reply::select('replies.*', 'users.name')
        ->leftJoin('users', 'replies.user_id', '=', 'users.id')
        ->where('replies.id',  $reply->id)
        ->first();

        // dd($status->reply_id);
        
        // 再返信の取得
        $replies = Reply::select('replies.*', 'users.name')
        ->leftJoin('users', 'replies.user_id', '=', 'users.id')
        ->where('replies.reply_id', $reply->id)
        ->orderby('replies.created_at', 'desc')
        // ->get();
        ->simplePaginate(5);

        return view('/reply/show', [
                'post' => $post,
                'reply' => $reply,
                'status' => $status,
                'replies' => $replies,
        ]);
    }

    // 再返信
    public function comment(replyRequest $request, Post $post, Reply $reply)
    {
        $user = Auth::user();

        // $this->validate($request, Reply::$rules);
        $new_reply = new Reply;
        $new_reply->posts = $request->posts;
        $new_reply->user_id = $user->id;
        $new_reply->post_id = $post->id;
        // is_replyにreplyのidを設定
        $new_reply->reply_id = $reply->id;

        // 画像の保存
        if($request->image){
        $file_name = $request->file('image')->getClientOriginalName();
        $new_reply->image = $request->file('image')->storeAs('public', $file_name);
        }
        
        $new_reply->save();

        return redirect("/post/$post->id/reply/$reply->id");
    }
}
