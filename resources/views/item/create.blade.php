@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">@lang('content.create_new_item')</div>
            <div class="card-body">
                <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group">
                        <div class="control-label" for="category_id">Category</div>
                        <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id">
                            @foreach(\App\Models\ItemCategory::get()->pluck('name', 'id') as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
                    </div>
                    <div class="form-group">
                        <div class="control-label" for="title">Title</div>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ old('title') }}">
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    </div>
                	<div class="form-group">
                		<div class="control-label" for="content">Content</div>
                		<textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>
                		<div class="invalid-feedback">{{ $errors->first('content') }}</div>
                	</div>
                	<div class="form-group">
                		<div class="control-label" for="thumbnail">Thumbnail</div>
                		<input type="file" class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" name="thumbnail">
                		<div class="invalid-feedback">{{ $errors->first('thumbnail') }}</div>
                	</div>
                	<button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
