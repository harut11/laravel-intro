@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">All items</div>

            <div class="card-body">
                <div class="row">
                    @if($models->count())
                        @foreach($models as $model)
                            @include('item._item', ['model' => $model])
                        @endforeach
                    @else
                        <div class="col-sm-12">
                            <h4 class="text-danger">
                                No posts found
                            </h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
