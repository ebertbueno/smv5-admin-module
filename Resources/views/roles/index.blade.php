@extends( Config::get('themes.backend') )

@section('content')
  <section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			{!! link_to_route('admin.roles.create', 'Add New') !!}
			Panel heading petition
		</div>
		<div class="panel-body">
			<div>
				&middot;
				<small>All Roles ({!! $roles->count() !!})</small>
			</div>
			<table class="table">
				<thead>
					<th>No</th>
					<th>Name</th>
					<th>Alias</th>
					<th>Description</th>
					<th>Permissions</th>
					<th>Created At</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody>
					@foreach ($roles as $role)
					<tr>
						<td>{!! $no !!}</td>
						<td>{!! $role->name !!}</td>
						<td>{!! $role->slug !!}</td>
						<td>{!! $role->description !!}</td>
						<td>
							@foreach($role->permissions as $permission)
								&bullet; {!! $permission->name !!}<br>
							@endforeach
						</td>
						<td>{!! $role->created_at !!}</td>
						<td class="text-center">
							<a href="{!! route('admin.roles.edit', $role->id) !!}">Edit</a>
							&middot;
							@include('admin::partials.modal', ['data' => $role, 'name' => 'roles'])
						</td>
					</tr>
					<?php $no++ ;?>
					@endforeach
				</tbody>
			</table>

			<div class="text-center">
				{!! pagination_links($roles) !!}
			</div>

		</div>
	</div>

  </section>
@stop
