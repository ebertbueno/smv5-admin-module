<div class="panel panel-info">
  <div class="panel-body">
    	<div class="col-md-6 "><h4><i class="glyphicon glyphicon-th"></i> Dashboard - Welcome {{ Auth::user()->name }}</div>
    	<div class="col-md-3 "><h4><i class="glyphicon glyphicon-th"></i> Modules: {{ Module::count() }}</div>
    	<div class="col-md-3"><h4><i class="glyphicon glyphicon-user"></i> Users: {{ App\User::all()->count() }}</div>
  </div>
</div>