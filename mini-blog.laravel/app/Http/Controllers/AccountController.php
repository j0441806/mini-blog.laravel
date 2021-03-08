<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Following;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\signupRequest;
use App\Http\Requests\signinRequest;
use App\Http\Requests\profileRequest;
use App\Http\Requests\imageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AccountController extends Controller
{
    // 新規ユーザー登録
    public function signup()
    {
        return view('account.signup');
    }

    // 登録内容確認
    public function confirm(signupRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        return view('account.confirm', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    // 登録処理
    public function register(Request $request)
    {
        // バリデーション
        // $this->validate($request, User::$rules);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        // パスワードのハッシュ化
        $user->password = Hash::make($request->password);
        $user->save();

        // 新規作成した会員情報をDBから取得
        $new_user = User::where('name', $request->name)->first();

        if ($new_user) {
            $email = $new_user->email;
            // ハッシュ化前のパスワード
            $password = $request->password;
            // ログイン処理
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $message = $new_user->name . 'さん、会員登録に成功しました！';
            } else {
                // ログイン失敗
                $message = 'ログイン処理に失敗しました。もう一度ログインをお願いいたします。';
                return view('account.error', ['message' => $message]);
            }
        } else {
            // DB登録失敗
            $message = '会員登録に失敗しました。もう一度会員登録をお願いいたします。';
            return view('account.error', ['message' => $message]);
        }
        return view('account.success', ['message' => $message]);

        // return redirect('/post')
        // ->with('user', $new_user);
    }

    public function index(Request $request)
    {
        // ログインユーザーの取得
        $user = Auth::user();

        if ($user) {
            $message = 'ログインしています。';
            // フォローユーザーの取得
            $following_users = User::select()
            ->Join('followings', 'users.id', '=', 'followings.following_id')
            ->where('followings.user_id', '=', $user->id)
            ->get();
            
            // 自分をフォローしているユーザー
            $followed_users = User::select()
            ->leftJoin('followings', 'users.id', '=', 'followings.user_id')
            ->where('followings.following_id', '=', $user->id)
            ->get();
        }

        return view('account.index', [
            'user' => $user,
            'message' => $message,
            'following_users' => $following_users,
            'followed_users' => $followed_users,
            ]);
    }

    // ログイン
    public function signin(Request $request)
    {
        $email = null;
        // Cookieの取得
        if ($request->hasCookie('email')) {
            $email = Cookie::get('email');
        } else {
            $email = old('email');
        }
        return view('account.signin', ['email' => $email]);
    }

    public function auth(signinRequest $request)
    {
        // $this->validate($request, [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
        
        $email = $request->email;
        $password = $request->password;
        // ログイン処理
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $message = 'ログインしています。';
            // ログインユーザーの取得
            $user = Auth::user();
            // フォローユーザーの取得
            $following_users = User::select()
            ->leftJoin('followings', 'users.id', '=', 'followings.following_id')
            ->where('followings.user_id', '=', $user->id)
            ->get();
            // 自分をフォローしているユーザー
            $followed_users = User::select()
            ->leftJoin('followings', 'users.id', '=', 'followings.following_id')
            ->where('followings.following_id', '=', $user->id)
            ->get();

        } else {
            $message = 'ログインに失敗しました。お手数ですが、もう一度ログインしてください。';
            return view('account.error', ['message' => $message]);
        }
        // Cookieにメールアドレスを保存
        if ($request->check === 'on') {
            Cookie::queue('email', $email, 60*24*14);
        }
        return view('account.index', [
            'message' => $message,
            'user' => $user,
            'following_users' => $following_users,
            'followed_users' => $followed_users,
            ]);
    }

    // ログアウト
    public function signout(Request $request)
    {
        Auth::logout();

        return redirect('account/signin');
    }

    // フォロー
    public function follow(Request $request)
    {
        $following_id = $request->following_id;
        if (!$following_id) {
            $msg = 'フォローユーザーのデータ送信に失敗しました。';
            return view('account.error', ['message' => $msg]);
            // return redirect('/account');
        }

        // フォローしたいユーザーの取得
        $following_user = User::where('id', $following_id)->first();
        if (!$following_user) {
            $msg = 'フォローユーザーのデータ取得に失敗しました。';
            return view('account.error', ['message' => $msg]);
            // return redirect('/account');
        }

        // ログインユーザーの取得
        $user = Auth::user();

        // 既にフォロー済みでないかをチェック
        $is_following = false;
        $cnt_following = Following::where('user_id', $user->id)
            ->where('following_id', $following_user->id)
            ->count('user_id');

        // フォロー済みの場合
        if ($cnt_following !== 0) {
            $is_following = true;
            $msg = 'すでにフォローしています。';
            return view('account.error', ['message' => $msg]);
        }

        // ログインユーザーと別のユーザーかつすでにフォロー済みでない場合
        if (($user->id !== $following_user->id) && !$is_following)
        {
            $following = new Following;
            $following->user_id = $user->id;
            $following->following_id = $following_user->id;
            $following->save();
        }

        // return redirect('/account');
        return redirect("/user/$request->following_id");
    }

    // フォロー解除
    public function unfollow(Request $request)
    {
        Following::where('following_id', $request->unfollowing_id)
            ->delete();

        return redirect("/user/$request->unfollowing_id");
    }

    // 全ユーザーの表示
    public function showall()
    {
        $users = User::select()
            ->simplePaginate(10);

        return view('account.allusers', ['users' => $users]);
    }

    // 自己紹介登録
    public function submitProfile()
    {
        $user = Auth::user();
        return view('account.profile', ['user' => $user]);
    }

    // 自己紹介登録処理
    public function createProfile(profileRequest $request)
    {
        $item = $request->description;
        $id = $request->user_id;

        User::where('id', $id)
            ->update(['description' => $item]);

        return redirect("account");
    }

    // プロフィール画像登録
    public function submitImage()
    {
        $user = Auth::user();
        return view('account.image', ['user' => $user]);
    }

    // プロフィール画像登録処理
    public function createImage(imageRequest $request)
    {
        $id = $request->user_id;

        // 画像の保存
        if($request->image){
            // 元のファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            $modified_name = date("YmdHis") . '_' . $file_name;
        }

        User::where('id', $id)
            ->update(['image' => $request->image->storeAs('public', $modified_name)]);

        return redirect("account");
    }

    // お気に入り一覧
    public function showFavorites()
    {
        $user = Auth::user();
        $favorites = Post::leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('favorites', 'posts.id', '=', 'favorites.post_id')
        ->where('favorites.user_id', $user->id)
        ->select('posts.*', 'users.name')
        ->orderby('favorites.created_at', 'desc')
        ->simplePaginate(5);

        return view('account.favorites', [
            'user' => $user,
            'favorites' => $favorites,
            ]);
    }

}
