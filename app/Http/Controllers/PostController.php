<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Comment;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Faker\Factory;
use Carbon\Carbon;



class PostController extends Controller
{
	// ↓ トップページのコントローラー。postsテーブルの情報を取得し、viewにわたす
    public function index(){
    	$posts = Post::latest()->with(['category','user'])->paginate(10);
    	return view('post.index',['posts' => $posts]);
    }

	// ↓ 投稿の新規作成ページのviewをリターンするメソッド
    public function create(){
    	// ↓ 新規作成ページでは、どのカテゴリーに属する投稿なのかをドロップダウンで選択してもらう。そのため、新規作成ページに、カテゴリテーブルの全情報を渡す処理を記述
		$categories = Category::all();
	    return view('post.create', ['categories' => $categories]);
    }

	// ↓ 投稿の新規作成内容をデータベースへ挿入するメソッド
    public function store(PostRequest $request){
		// ↓ 新規作成ページでは誰の投稿なのか、という情報を使用して、データベースに入力する必要があるため、新規作成ページへ遷移するにあたり、user情報を渡す
        $user = Auth::user();
        //投稿された画像ファイルの元画像名を取得
        $file_name = $request->file('file')->getClientOriginalName();
        //同じ画像が投稿された場合に、異なる画像として識別するために、投稿された画像名に、投稿日時を追加する。ユニークな画像名を作成
        $file_name_to_store = time() .  '_' . $file_name;
        //投稿された画像ファイルをLaravelapp内のディレクトリ(public)に保存
        $request->file('file')->storeAs('public',$file_name_to_store);
		$post = Post::create([
			'user_id' =>  $user->id,
			'category_id' => $request->category_id,
			'title' => $request->title,
			'body' => $request->body,
            'image' => $file_name_to_store,
		]);
        //以下の記述で画像ファイルのアップロードができる
        //file('file')の'file'箇所は、inputタグのname属性に記載した値を記載する
		return redirect('/');
    }

	// ↓ 投稿の詳細ページを表示するメソッド
    public function show($post_id){
    	// ↓ index.bladeの詳細を見るボタンをクリックした際に、該当の数字が$post_idとして渡されている（webに{post_id}と書いているから$post_id）。そのデータをキーとしてpostsテーブルから該当の情報を引っ張ってきている。その際に、リレーションを使用して、他のテーブルの情報も引っ張った。
    	// ↓ また、Commentクラスを使用して、現在の$post_idとイコールのpost_idを持つ、コメントテーブルの情報を新着順に取得するという記述を記載。そのデータを詰め込んだ、$commentsをビューに渡すことで、詳細ページでは、ひもづくコメントを全て記載するという記述を行う
	    $post = Post::with(['category','user'])->findOrFail($post_id);
	    $comments = Comment::with(['user','post'])->where('post_id',$post_id)->latest()->get();
    	return view('post.show', ['post' => $post,'comments' => $comments]);
    }

		// ↓ 編集ページでは、カテゴリーを選択形式で選べる必要があるので、全てのカテゴリーを取得。また、編集ページで表示する情報は、該当のpostのレコードのみなので、受け取った$post_idをキーとして、postテーブルからデータを取得。両方の情報を詳細ページに渡す
    public function edit($post_id){
		$categories = Category::all();
    	$post = Post::findOrFail($post_id);
    	return view('post.edit', ['post' => $post,'categories' => $categories]);
    }

	//  ↓ 編集ページで記述したデータの内容をデータベースに投稿し、アップデートする処理を記述。該当の$post_idとイコールのidを持つpostsテーブルの情報をwhereで取り出し、そこに対して、updateメソッドを実行。メソッド内では、更新したいカラムを左に記述し、右にそこに挿入したいデータを記述。全てリクエスト情報を挿入する。書き込みが終わったらトップページをリダイレクトする
    public function update(PostRequest $request,$post_id){
        if($request->hasFile('file')){
            $file_name = $request->file('file')->getClientOriginalName();
            $file_name_to_store = time() .  '_' . $file_name;
            $request->file('file')->storeAs('public',$file_name_to_store);
            $post = Post::findOrFail($post_id);
            Storage::disk('public')->delete($post->image);
            $post->update([
            'image' => $file_name_to_store,
            ]);
        }

    	Post::where('id',$post_id)->update([
    		'title' => $request->title,
    		'body' => $request->body,
    		'category_id' => $request->category_id,
    	]);



    	return redirect('/');
    }
    // 投稿を削除するメソッド。bladeからidを渡してきて、そのidに紐づくレコードを取り出し、削除処理をするという流れ
    public function delete($post_id){
    	$post = Post::findOrFail($post_id);
        // storage>publicの下にあるpost_idに紐づくファイルを削除
        Storage::disk('public')->delete($post->image);
    	$post->delete();
    	return redirect('/');
    }
}
