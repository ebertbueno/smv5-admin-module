@extends( Config::get('themes.backend') )

@section('content')
<section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit &middot; <small>{!! link_to_route('admin.permissions.index', 'Back') !!}</small>
		</div>
		<div class="panel-body">
			
			<div>
				@include('admin::permissions.form', array('model' => $permission))
			</div>

		</div>
	</div>
</section>
@stop
