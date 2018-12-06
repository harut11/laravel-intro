@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">All items</div>

            <div class="card-body">
                <div class="row">
                    @foreach($models as $model)
                        @include('item._item', ['model' => $model])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
