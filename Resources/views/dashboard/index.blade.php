@extends( Config::get('themes.backend') )

@section('content')

	<aside class="sidebar col-md-3 hide">
		<div class="col-md-12">
			@foreach($sidebars as $sidebar) 
				{!! $sidebar !!}
			@endforeach
		</div>
	</aside>
	<section class="container-fluid">
			@foreach($widgets as $widget) 
				{!! $widget !!}
			@endforeach
	</section>
	<?php 
			/*$sm = DB::connection()->getDoctrineSchemaManager();
			$fields = $sm->listTableColumns('users');
			foreach ($fields as $field) 
			{
			    print_r($field);
			}*/
	 ?>
@stop

