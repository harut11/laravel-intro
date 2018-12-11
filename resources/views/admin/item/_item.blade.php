<tr>
	<td>{{ $model->id }}</td>
	<td>{{ $model->title }}</td>
	<td>{{ str_limit($model->content, 100) }}</td>
	<td>{{ $model->owner->name }}</td>
	<td>{{ $model->category->name }}</td>
	<td>
		<a href="{{ route('admin.item.show', $model->id) }}">
			<i class="fa fa-eye"></i>
		</a>
		<a href="{{ route('admin.item.edit', $model->id) }}">
			<i class="fa fa-pencil"></i>
		</a>
		<a href="{{ route('admin.item.delete', $model->id) }}" data-method="delete" data-confirm="Are You sure You want to delete this shit?">
			<i class="fa fa-trash"></i>
		</a>
	</td>
</tr>