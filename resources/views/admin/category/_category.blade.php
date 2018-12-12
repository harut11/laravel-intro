<tr>
	<td>{{ $model->id }}</td>
	<td>{{ $model->name }}</td>
	<td>{!!html_entity_decode($model->icon)!!}</td>
	<td>
		<a href="{{ route('admin.category.show', $model->id) }}">
			<i class="fa fa-eye"></i>
		</a>
		<a href="{{ route('admin.category.edit', $model->id) }}">
			<i class="fa fa-pencil"></i>
		</a>
		<a href="{{ route('admin.category.delete', $model->id) }}" data-method="delete" data-confirm="Are You sure You want to delete this shit?">
			<i class="fa fa-trash"></i>
		</a>
	</td>
</tr>