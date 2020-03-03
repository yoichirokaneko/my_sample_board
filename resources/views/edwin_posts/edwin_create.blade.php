@extends('edwin_layouts.edwin_app')


@section('content')

<form action="post" action="posts">
	
	<input type="text" name="title" placeholder="Enter title">

	<input type="submit" name="submit">
</form>


@yield('footer')