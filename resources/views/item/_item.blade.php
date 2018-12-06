<div class="col-sm-3">
    <img src="{{ asset('/uploads/' . $model->thumbnail) }}" class="img-fluid">
    <h4>
        <a href="{{ url('/items/' . $model->id) }}">
            {{ $model->title }}
        </a>
    </h4>
    <p>{{ str_limit($model->content, 50) }}</p>
    @auth
    	<a href="{{ url('/items/' . $model->id . '/edit') }}" class="btn btn-warning">Edit</a>
    	<form action="{{ url('/items/' . $model->id) }}" method="post" style="display: inline">
    		@csrf
    		@method('delete')
    		<input type="submit" value="Delete" class="btn btn-danger">
    	</form>
    @endauth
</div>