@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">{{ $model->title }}</div>

            <div class="card-body">
                {!!html_entity_decode($model->content)!!}
            </div>
        </div>
        <div class="card mt-3">
        	<div class="card-header">Comments</div>
        	<div class="card-body">
            	<form action="{{ route('comment.store', $model->id) }}" method="post">
                	@csrf
                	<textarea name="message" id="message" cols="30" class="form-control"></textarea>
                	<button type="submit" class="btn btn-success">Send</button>
                </form>
                @foreach($model->comments()->with('author')->get() as $comment)
                		<div>
                			{{ $comment->message }}
		                	<div>
		            			<small>{{ $comment->author->name }}</small>
		            		</div>
                		</div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
