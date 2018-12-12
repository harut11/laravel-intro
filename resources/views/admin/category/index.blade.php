@extends('admin.layouts.app')

@section('content')
	<table class="table table-condensed table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Icon</th>
			</tr>
		</thead>
		<tbody>
			@each('admin.category._category', $models, 'model', 'admin.category._empty')
		</tbody>
		<tfoot>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Icon</th>
			</tr>
		</tfoot>
	</table>

@endsection