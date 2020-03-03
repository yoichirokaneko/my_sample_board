@extends('layouts.app')

@section('content')
	<div class="container">
 	<h1>コメントの編集ページ</h1>
 	 	<form method="POST" action="{{ action('CommentController@update', $comment->id) }}">
 	 		 		{{ csrf_field() }}
 	  		@if (count($errors) > 0)
			    @foreach ($errors->all() as $error)
			        {{ $error }}
			    @endforeach
			@endif

			<div class="form-group">
		        <label for="body">コメント内容</label>
		        <textarea class="form-control" id="comment" name="comment" rows="5">{{ $comment->comment }}</textarea>
		    </div>
			<button type="submit" class="btn btn-primary">書き込む</button>
		</form>
	</div>
@endsection