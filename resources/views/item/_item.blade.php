<div class="col-sm-3">
    <img src="{{ $model->small_thumb_url }}" class="img-fluid">
    <h4>
        <a href="{{ route('items.show', $model->slug) }}">
            {{ $model->title }}
        </a>
    </h4>
    <p>{{ str_limit($model->content, 50) }}</p>
    <p>{{ $model->owner->name }}</p>
    @if (Auth::check() && $model->owner_id === Auth::id())
    	<a href="{{ route('items.edit', $model->id) }}" class="btn btn-warning">Edit</a>
    	<form action="{{ route('items.delete', $model->id) }}" method="post" style="display: inline">
    		@csrf
    		@method('delete')
    		<input type="submit" value="Delete" class="btn btn-danger">
    	</form>
    @endauth
</div>