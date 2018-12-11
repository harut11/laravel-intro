@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Profile Settings</div>

            <div class="card-body">
                <form action="{{ route('user.profile') }}" method="post" enctype="multipart/form-data">
                	@csrf
                    @method('put')
                    <div class="form-group">
                        <label class="control-label" for="details_first_name">First Name</label>
                        <input type="text" class="form-control {{ $errors->has('details.first_name') ? 'is-invalid' : '' }}" name="details[first_name]" value="{{ $model->details->first_name }}">
                        <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="details_last_name">Last Name</label>
                        <input type="text" class="form-control {{ $errors->has('details.last_name') ? 'is-invalid' : '' }}" name="details[last_name]" value="{{ $model->details->last_name }}">
                        <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                    </div>
                	<button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection