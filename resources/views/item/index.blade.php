@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">All items</div>

            <div class="card-body">
                <div class="row">
                    @foreach($models as $model)
                        <div class="col-sm-3">
                            <img src="/uploads/{{ $model->thumbnail }}" class="img-fluid">
                            <h4>
                                <a href="/items/{{ $model->id }}">
                                    {{ $model->title }}
                                </a>
                            </h4>
                            <p>{{ str_limit($model->content, 50) }}</p>
                            @auth
                            <a href="items/edit/{{ $model->id }}" class="btn btn-warning">Edit</a>
                            <a href="items/destroy/{{ $model->id}}" class="btn btn-danger">Delete</a>
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection