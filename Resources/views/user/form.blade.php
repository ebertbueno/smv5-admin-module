<!-- section start -->
<!-- ================ -->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h3>Gerenciar Usuários</h3>
</div>
<div class="modal-body">
	<div class="row">
					<form class='form-horizontal' ng-submit="save(  modalstate, form.id, '{{ csrf_token() }}' ) ">
					<div class="col-md-12">
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
							<div class="col-md-6" ng-class="{'has-error':error.level != null}">
								{!! Form::select('level', [], 1, ['class'=>'form-control', 'ng-model'=>'form.level', 'ng-options'=>"v.id as v.name for v in levels"] ) !!}
								<span class="help-inline" ng-show="error.level != null">@{{ error.level.join("\r\n") }}</span>
							</div>
							<div class="col-md-6" ng-class="{'has-error':error.status != null}">
								{!! Form::select('status', [], 1, ['class'=>'form-control', 'ng-model'=>'form.status', 'ng-options'=>"v.id as v.name for v in allstatus"] ) !!}
								<span class="help-inline" ng-show="error.status != null">@{{ error.status.join("\r\n") }}</span>
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