@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">All items</div>

            <div class="card-body">
                <div class="row">
                    @each('item._item', $models, 'model', 'item._empty')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
