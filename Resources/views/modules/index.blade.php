@extends( Config::get('themes.backend') ) 

@section('content')
<section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			All Modules ( {{ Module::count() }} )
		</div>
		<div class="panel-body">
	
			<table class="table">
				<thead>
					<th>No</th>
					<th>Name</th>
					<th>Path</th>
					<th>Status</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@forelse($enabled as $module)
					<tr>
						<td>{!! '1' !!}</td>
						<td>{!! $module->getStudlyName() !!}</td>
						<td>{!! $module->getPath() !!}</td>
						<td>{!! 'Enabled' !!}</td>
						<td>{!! link_to_route('admin.modules.disable', 'Disable', ['name'=>$module->getStudlyName()] ) !!}</td>
					</tr>
					@empty

					@endforelse
					@forelse($disabled as $module)
					<tr class="active">
						<td>{!! '1' !!}</td>
						<td>{!! $module->getStudlyName() !!}</td>
						<td>{!! $module->getPath() !!}</td>
						<td>{!! 'Disabled' !!}</td>
						<td>{!! link_to_route('admin.modules.enable', 'Enable', ['name'=>$module->getStudlyName()] ) !!}</td>
					</tr>
					@empty

					@endforelse
				</tbody>
			</table>

		</div>
	</div>
</section>
@stop
