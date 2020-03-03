<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
	// ↓ コメントを書き込む際にボタンをクリックした時に発動するメソッド。記載の内容がデータベースに書き込まれる。
	//  ↓ メソッドの引数は、バリデーションチェックをかけた、リクエスト情報を取得するための、CommentRequestを$request変数に詰める、という記述と、viewから渡されてきた、URLに当てはめる変数を受け取る$post_idという箱の記述が記載されている。
	// Authクラスは、現在ログインしているuserの情報を取得できる。インスタンスとして$userを生成。$userを使用し、commentsテーブルに現在ログインしているユーザーのid情報を詰め込む。
    public function store(CommentRequest $request,$post_id){
    	$user = Auth::user();
		$comment = Comment::create([
			// ↓ ログイン情報からuser_idへ挿入。ビューから渡されてきた値からpost_idを挿入。書き込まれたpostメソッドでrequestされた情報からcommentを挿入。
			'user_id' => $user->id,
			'post_id' => $post_id,
			'comment' => $request->comment,
		]);
		// ↓ 書き込みが終われば、今いる投稿の詳細ページへリダイレクトする。変数を渡すアドレスへのリダイレクトとなるため、routeに名前をつけて、route関数を使用することで、ルートの指定と変数の渡しを両立させている
		return redirect()->route('show',['post_id' => $post_id]);
    }

	// ↓ Commentテーブルから該当のidを持つレコードの情報を取得し、$comment変数に詰め込む。変数をviewに渡す。
    public function edit($comment_id){
    	$comment = Comment::findOrFail($comment_id);
    	return view('comment.edit',['comment' => $comment]);
    }

	// ↓ 編集ページで再編集した既存コメントの更新メソッド。編集ページで記載した内容に対して、CommentRequestでバリデーションをかける。さらに、CommentRequestに詰め込まれたRequest情報を変数$requestへ詰めている。第二引数は、URLで受け取っている変数{comment_id}の値を$comment_idとして受け取っている。
    public function update(CommentRequest $request,$comment_id){
    	//↓  ModelのCommentメソッドを呼び出し、受け取った変数$comment_idとイコールのidのレコードに対して、updatemをかける
    	Comment::where('id',$comment_id)->update([
    		'comment' => $request->comment,
    	]);
    	// ↓ 同じく、該当のレコードを引っ張り出し、その中から、valueメソッドにより、post_idの値のみを取得。それを変数$commentに格納。リダイレクト時に、当該詳細ページにリダイレクトするための処理
    	$comment = Comment::where('id',$comment_id)->value('post_id');
    	return redirect()->route('show',['post_id' => $comment]);
    }
		// ↓ コメントを削除するメソッド。受け取った変数をidとしてもつ、Commentテーブルのレコードを取り出し、削除を実行。リターンバックで直前のページに戻す。
    public function delete($comment_id){
			$comment = Comment::findOrFail($comment_id);
			$comment->delete();
			return back();
    }
}
