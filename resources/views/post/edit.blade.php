@extends('layouts.app')


@section('content')
	<div class="container">
 	<h1>投稿の編集ページ</h1>
 	 	<form method="POST" action="{{ action('PostController@update', $post->id) }}">
 	 		 		{{ csrf_field() }}
 	  		@if (count($errors) > 0)
			    @foreach ($errors->all() as $error)
			        {{ $error }}
			    @endforeach
			@endif
			<div class="form-group">
			    <label for="title">タイトル</label>
			    <!-- タイトル欄をinputとして用意。既存のタイトルデータの内容を予め表示しておくために、value属性に値を記載 -->
			    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title}}">
			</div>

			<div class="form-group">
			    <label for="category">カテゴリー</label>
			    <!-- カテゴリーも編集できるように、プルダウン形式で表示。しかし、元々の情報を予め選択した形で表示した方が、ユーザーにとって使いやすいため、「optionタグ内のselectedという属性を該当のpostsテーブルのレコードが持っているcategory_idと=のcategory_idの場合のみ表示させる」、 という技により、予め選択させる記述を用意-->
			    <select name="category_id" id="category">
			    	@foreach($categories as $category)
			    	<option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : "" }} >{{ $category->category_name }}</option>
			    	@endforeach
			    </select>
			</div>

			<div class="form-group">
		        <label for="body">投稿内容</label>
		        <textarea class="form-control" id="body" name="body" rows="5">{{ $post->body }}</textarea>
		    </div>
			<button type="submit" class="btn btn-primary">書き込む</button>
		</form>
	</div>
@endsection