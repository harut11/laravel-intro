@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">List of categories</div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('items.index', [
                                        'owner' => request()->route('owner'),
                                        $category->slug,
                                        'search' => request()->get('search')
                                    ]) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">All items</div>

                    <div class="card-body">
                        <div class="row">
                            @each('item._item', $models, 'model', 'item._empty')
                        </div>
                        <div class="d-flex mt-3 justify-content-center">
                            {{ $models->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
