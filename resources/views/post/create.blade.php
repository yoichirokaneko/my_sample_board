@extends('layouts.app')

@section('content')
<div class="container">
 	<h1>投稿の新規作成</h1>
 	<!-- フォームタグのすぐ下に、セキュリティ対策を記述 -->
 	<form method="POST" action="{{ url('/post/create') }}" enctype="multipart/form-data">
 		{{ csrf_field() }}
	<!-- バリデーション用に作成した、formrequestのバリデーションが満たされない場合に、エラーメッセージを表示するための、if文。もし、バリデーションの条件が満たされない場合、該当のエラー文言が表示される -->
		@if (count($errors) > 0)
		    @foreach ($errors->all() as $error)
		        {{ $error }}
		    @endforeach
		@endif

 	<!-- 投稿のタイトルを記述するフォーム。 -->
	  <div class="form-group">
	    <label for="title">タイトル</label>
	    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
	  </div>

	<!-- カテゴリーを選択するフォームの記述。ドロップダウンから選択。選択内容はカテゴリーテーブルから取得。コントローラーで取得し、ビューに渡してきたデータを使用 -->
	  <div class="form-group">
	    <label for="title">カテゴリー</label>
	    <select name="category_id">
	    	@foreach($categories as $category)
	    	<option value="{{ $category->id }}">{{ $category->category_name }}</option>
	    	@endforeach
	    </select>
	  </div>

       <!-- 画像を投稿するための機能を実装 -->
       <label for="file">投稿画像</label>
	  <input type="file" id="file" name="file" class="form-control">

	<!-- postsテーブルのbodyカラムに挿入するデータを記載する場所。name属性に記載した文言をコントローラーでrequestメソッドで引き出せる -->
	  <div class="form-group">
        <label for="body">投稿内容</label>
        <textarea class="form-control" id="body" name="body" value="{{ old('body') }}" rows="3"></textarea>
      </div>
	  <button type="submit" class="btn btn-primary">書き込む</button>
	</form>
</div>
@endsection