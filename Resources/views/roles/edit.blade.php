@extends( Config::get('themes.backend') )

@section('content')
<section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit &middot; <small>{!! link_to_route('admin.roles.index', 'Back') !!}</small>
		</div>
		<div class="panel-body">
			
			<div>
				@include('admin::roles.form', array('model' => $role) + compact('permission_role'))
			</div>

		</div>
	</div>
</section>
@stop
