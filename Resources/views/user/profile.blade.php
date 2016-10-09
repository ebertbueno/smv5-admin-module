@extends( Config::get('themes.backend') )

@section('content')
<section class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('admin::profile.myprofile') }}
			</div>
			<div class="panel-body">
				<form class='form-horizontal' ng-submit="save( form.id, '{{ csrf_token() }}' ) ">
					<div class="col-md-12">
						<div ng-show="status.type == 'success'" class="alert alert-success">@{{ status.message }}</div>
						<div ng-show="status.type == 'error'" class="alert alert-danger" >@{{ status.message }}</div>
						<div class="form-group">
								<div class="col-md-6" ng-class="{'has-error':error.name != null}">
									{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.name'), "ng-model"=>"form.name"] ) !!}
									 <span class="help-inline" ng-show="error.name != null">@{{ error.name.join("\r\n") }}</span>
								</div>	
								<div class="col-md-6">
									{!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.lastname'), 'ng-model'=>'form.last_name'] ) !!}

							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6" ng-class="{'has-error':error.email != null}">
								{!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.email'), 'ng-model'=>'form.email'] ) !!}
								<span class="help-inline" ng-show="error.email != null">@{{ error.email.join("\r\n") }}</span>
							</div>	
							<div class="col-md-6" >
								{!! Form::select('language', [], 'en', ['class'=>'form-control', 'ng-model'=>'form.language', 'ng-options'=>"v.id as v.name for v in languages"] ) !!}
								<span class="help-inline" ng-show="error.language != null">@{{ error.language.join("\r\n") }}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6" ng-class="{'has-error':error.password != null}">
								{!! Form::password('password', ['class'=>'form-control','placeholder'=>trans('admin::profile.password'), 'ng-model'=>'form.password'] ) !!}
								<span class="help-inline" ng-show="error.password != null">@{{ error.password.join("\r\n") }}</span>
							</div>	
							<div class="col-md-6" ng-class="{'has-error':error.password_confirmation != null}">
								{!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>trans('admin::profile.password'), 'ng-model'=>'form.password_confirmation'] ) !!}
								<span class="help-inline" ng-show="error.password_confirmation != null">@{{ error.password_confirmation.join("\r\n") }}</span>
							</div>
						</div>
						
						<div class="form-group">
							{!! Form::label(' ', '') !!}
							<div class="col-md-12">
								<button type="submit" id="btn-sign" class="btn btn-success" >{{ trans('admin::layout.save') }}</button>
								<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('admin::layout.close') }}</button>
							</div>
						</div>
				</div>
				<div class="clearfix"></div>
			{!! Form::close() !!}
		</div>
	</div>
</section>
@endsection

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
  <!-- http://www.tutorials.kode-blog.com/laravel-5-angularjs-tutorial -->
@endsection

@section('script')

angular.module('app', [])

  .constant('API_URL', $('base').attr('href') )

  .config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }])
  
  .controller('PageController', function($scope, $http, API_URL) 
  {
  		var form = {language:"en"};
		$scope.form = form;
		$scope.languages = [ {id:"en", name:"English"},{id:"pt",name:"Português"} ];

  		$http.get( API_URL+'/admin/users/profile/edit')
			.success(function(response) {
					  $scope.form = response;
			});

		$scope.save = function(id, token) 
			{
					var url = API_URL + "/admin/users";
					$scope.form._token = token;
					$scope.form._method = "POST";
					$scope.error = {};

					url += "/" +id;
					$scope.form._method = "PATCH";

					$http({
							method: 'POST',
							url: url,
							data: $.param($scope.form),
							headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					}).success(function(response) 
					{
							$scope.status = {type:'success', 'message':response.message};
					}).error(function(response) 
					{
							$scope.status = {type:'error', 'message':response.message};
							$scope.error = response.error;
					});
			}
 });

@endsection
