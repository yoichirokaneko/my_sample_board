@extends('layouts.app')


@section('content')
<div class="container">
 	<h1>投稿の詳細ページ</h1>
	<div class="card">
	 	  <div class="card-header">
	 	  	<h5>タイトル：{{ $post->title }}</h5>
	 	  	<p class="card-text">投稿者：{{ $post->user->name }}</p>
	 	  	<p class="card-text">更新日時：{{ $post->updated_at }}</p>
	 	  	<p class="card-text">カテゴリー：{{ $post->category->category_name }}</p>
	 	  </div>
		  <div class="card-body">
		  	<img src="{{ asset('/storage/' . $post->image) }}" class="img-fluid">
		  	<!-- ↓ ママデータを表示すると、改行が反映されない。改行を反映するため、nl2br(e())というメソッドを使用。文字列エンコードはまだよく理解しきれていない！ -->
			  <p class="card-text">{!! nl2br(e($post->body)) !!}</p>
  		　</div>
  		  @guest
		  <div class="card-footer">
		  </div>
		  @else
		  <div class="card-footer">
		  	<!-- ↓ indexページと同じく、ログインユーザーが投稿した場合のみ、編集ボタン、削除ボタンを表示するためにif文で囲んでいる -->
		  	@if(Auth::user()->id == $post->user_id)
  			  <a href="{{ action('PostController@edit', $post->id) }}" class="btn btn-success">編集</a>
  			   <form
				    method="POST"
				    action="{{action('PostController@delete', $post->id)}}"
				  >
				    @csrf
				    @method('DELETE')
			      <button class="btn btn-danger">削除</button>
		      </form>
  			@endif
		  </div>
		  @endguest
	</div>

    <div class="form-group">
		<h2>コメント追加</h2>
		<!-- ↓ コメントをデータベースに追加するpost処理。該当のコントローラとurlに必要な変数を併せて渡す処理 -->
		<form method="POST" action="{{ action('CommentController@store', $post->id) }}">
			<!-- ↓ フォームの下に書いておく。セキュリティ対策 -->
				@csrf
				<!-- ↓ 作成したformrequestのバリデーションチェックに引っかかった場合は、エラーメッセージを表示する処理。定型文。 -->
				@if (count($errors) > 0)
				    @foreach ($errors->all() as $error)
				        {{ $error }}
				    @endforeach
				@endif
		    <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
		    <button type="submit" class="btn btn-primary">書き込む</button>
		</form>
	</div>


	<!-- ↓ commentsテーブルから、必要な情報と、リレーションを使用して、紐づくusersテーブルの情報を取得したもの（コントローラにて処理）を、表示するための記述 -->
	<h2>コメント一覧</h2>
	@foreach($comments as $comment)
	<div class="card">
		<div class="card-header">
	        <h5>投稿者：{{ $comment->user->name }}</h5>
	        <p class="card-text">更新日時：{{ $comment->updated_at }}</p>
	　　 </div>
		<div class="card-body">
		    <p class="card-text">{!! nl2br(e($comment->comment)) !!}</p>
		    <!-- ↓ ログインユーザーのidとコメントに紐づくuser_idがイコールの場合のみコメント編集、削除ボタンを表示させるために、if文で囲む。 -->
		    @guest
			@else
			  	@if(Auth::user()->id == $comment->user_id)
			  	<!-- コメント編集ページへのリンク。デザインでボタン風にしている。リンク先を指定。getする -->
			    <a href="{{ action('CommentController@edit', $comment->id) }}" class="btn btn-success">コメント編集</a>
				<!-- 削除機能の実装。deleteメソッドを使用するため、formでポスト指定した後ろに@deleteメソッドを使用。その後、ボタンタグでクリックする文言を囲む。それにより、削除ボタンが実装できる -->
			    <form
			    method="POST"
			    action="{{action('CommentController@delete', $comment->id)}}"
			    >
			    @csrf
			    @method('DELETE')
			    <button class="btn btn-danger">コメント削除</button>
				</form>
				@endif
			@endguest
		</div>
	</div>
	@endforeach
</div>
@endsection