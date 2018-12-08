<div class="col-sm-3">
    <img src="{{ asset('/uploads/' . $model->thumbnail) }}" class="img-fluid">
    <h4>
        <a href="{{ route('items.show', $model->id) }}">
            {{ $model->title }}
        </a>
    </h4>
    <p>{{ str_limit($model->content, 50) }}</p>
    @if (Auth::check() && $model->owner_id === Auth::id())
    	<a href="{{ route('items.edit', $model->id) }}" class="btn btn-warning">Edit</a>
    	<form action="{{ route('items.delete', $model->id) }}" method="post" style="display: inline">
    		@csrf
    		@method('delete')
    		<input type="submit" value="Delete" class="btn btn-danger">
    	</form>
    @endauth
</div>