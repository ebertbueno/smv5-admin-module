@extends( Config::get('themes.backend') )

@section('content')
<section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			{!! link_to_route('admin.permissions.create', 'Add New') !!}
			Panel heading petition
		</div>
		<div class="panel-body">
			<div>
				&middot;
				<small>All Permissions ({!! $permissions->count() !!})</small>
			</div>
			
			<table class="table">
				<thead>
					<th>No</th>
					<th>Name</th>
					<th>Alias</th>
					<th>Description</th>
					<th>Created At</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody>
					@foreach ($permissions as $permission)
					<tr>
						<td>{!! $no !!}</td>
						<td>{!! $permission->name !!}</td>
						<td>{!! $permission->slug !!}</td>
						<td>{!! $permission->description !!}</td>
						<td>{!! $permission->created_at !!}</td>
						<td class="text-center">
							<a href="{!! route('admin.permissions.edit', $permission->id) !!}">Edit</a>
							&middot;
							@include('admin::partials.modal', ['data' => $permission, 'name' => 'permissions'])
						</td>
					</tr>
					<?php $no++ ;?>
					@endforeach
				</tbody>
			</table>

			<div class="text-center">
				{!! pagination_links($permissions) !!}
			</div>

		</div>
	</div>
  </section>
@stop
