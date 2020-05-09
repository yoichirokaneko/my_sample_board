
<!-- 親＝app.blade.phpのソースを読み込む -->
@extends('layouts.app')

<!-- 親＝app.blade.phpのyield('content')に表示する内容、つまり、mainのソースを記述 -->
@section('content')
<div class="container">
 	<h1>投稿一覧</h1>
 	<div class="my-3" >
    <a href="{{ url('/post/create') }}" class="btn btn-primary">新規投稿作成</a>
 	</div>
 	</div>

<!-- コントローラーにおいて、データベースから値を取得し、その値をビューに渡す記述をしている。その値をこのbladeで受け取り、受け取ったデータを表示する記述を書いている -->
 	@foreach($posts as $post)
	 <div class="card">
	 	  <div class="card-header">
	 	  	<h5>タイトル：{{ $post->title }}</h5>
	 	  	<p class="card-text">投稿者：{{ $post->user->name }}</p>
	 	  	<p class="card-text">更新日時：{{ $post->updated_at }}</p>
	 	  	<p class="card-text">カテゴリー：{{ $post->category->category_name }}</p>
	 	  </div>
		  <div class="card-body">
		  	<!-- 画像を表示する記述 -->
		  	<!-- asset関数を使うことで、ファイルのディレクトリを気にすることなく、パスを記載できる -->
		  	<img width="300px" height="300px" src="{{ asset('/storage/' . $post->image) }}">
		  	<!-- 改行が挿入されているデータを改行として表示するための処理と、文字数を制限して表示するための処理を記述 -->
			  <p class="card-text">{!! nl2br(e(Str::limit($post->body,250))) !!}</p>
			  <!-- 詳細ページへのリンク。urlに変数を使用するため、変数を渡す記述方法を使用。actionメソッドを使用し、第２引数に渡したい変数を記述することで、その変数をcontrollerに渡せる -->
  			  <a href="{{ action('PostController@show', $post->id) }}" class="btn btn-primary">詳細を見る</a>
  		　</div>

	<!-- ログインしている時とログインしていない時で表示を分ける。ログインしていない時は、何も表示されない、divブロックのみを用意。 -->
		  @guest
		  <div class="card-footer">
		  </div>
		  <!-- 以下ログインしている場合の処理。ログインしている場合の処理は、さらに、ログインユーザーが投稿した投稿にのみ、紐づけて、編集ボタンと削除ボタンを表示する、という処理を記述 -->
		  @else
		  <div class="card-footer">
		  	<!-- 条件の中身は、ログインユーザーのidと投稿に紐づくuser_idがイコールの場合、ということ。編集リンクと削除ボタンの記述をifで囲むことで、条件に沿った場合のみボタンが現れる挙動を実現 -->
		  	@if(Auth::user()->id == $post->user_id)
	  			  <a href="{{ action('PostController@edit', $post->id) }}"  class="btn btn-success">編集</a>
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

		<!-- 管理者ログインしている場合のみ以下の要素を表示 -->
			@auth('admin')
			<div class="card-footer">
		  	    <form
				    method="POST"
				    action="{{action('PostController@delete', $post->id)}}"
				>
					 @csrf
					 @method('DELETE')
			     <button class="btn btn-danger">削除</button>　
				</form>
			</div>
		   @endauth

	 </div>
	 @endforeach

	 <div class="pagination justify-content-center">
		{{ $posts->links() }}
	</div>
</div>
@endsection