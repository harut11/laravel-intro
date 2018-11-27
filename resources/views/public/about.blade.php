@extends('template')

@section('content')
	@if (Auth::check())
		Hello {{ Auth::user()->name }}
	@else
		Welcome to our website
	@endif

	<ul>
	@foreach($cities as $city)
		<li>{{ $city }}</li>
	@endforeach
	</ul>
@endsection

@section('title')
	Hello World
@endsection