<div class="col-sm-3">
    <img src="/uploads/{{ $model->thumbnail }}" class="img-fluid">
    <h4>
        <a href="/items/{{ $model->id }}">
            {{ $model->title }}
        </a>
    </h4>
    <p>{{ str_limit($model->content, 50) }}</p>
    @auth
    	<a href="/items/edit/{{ $model->id }}" class="btn btn-warning">Edit</a>
    	<form action="/items/{{ $model->id }}" method="post" style="display: inline">
    		@csrf
    		@method('delete')
    		<input type="submit" value="Delete" class="btn btn-danger">
    	</form>
    @endauth
</div>