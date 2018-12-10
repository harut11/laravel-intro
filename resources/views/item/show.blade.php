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
    </div>
</div>
@endsection
