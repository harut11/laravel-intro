@extends('layouts.app')

@section('content')

<div class="container">
	
	<form action="{{ route('test.submit') }}" method="post">
		@csrf
		<div class="form-group">
			<div class="control-label" for="phone">phone</div>
			<input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" value="{{ old('phone') }}">
			<div class="invalid-feedback">{{ $errors->first('phone') }}</div>
		</div>

	</form>
</div>

@endsection
