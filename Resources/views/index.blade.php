@extends( Config::get('themes.backend') )

@section('content')
	<aside class="sidebar col-md-3 hide">
		<div class="col-md-12" style="background:#ccc;">
			@foreach($sidebars as $sidebar) 
				{!! $sidebar !!}
			@endforeach
		hauhaiua
		</div>
	</aside>
	<section class="container">
			@foreach($widgets as $widget) 
				{!! $widget !!}
			@endforeach
			...
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

