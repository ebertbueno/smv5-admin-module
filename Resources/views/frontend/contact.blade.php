@extends('theme.layout')

@section('content')


			<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">

				<div class="container">
					<div class="row">
						<div class="col-md-12">

								<h2>{!! trans('email.contact.text') !!}</h2>
								<div class="separator-2"></div>
								<div class="col-md-12">
												{!! Form::open(['method' => 'POST', 'action' =>'HomeController@sendContact', 'class' => 'form-horizontal']) !!}
														<div class="form-group">
															{!! Form::label('name', trans('profile.name'), ['class'=>'control-label col-md-3']) !!}
															<div class="col-md-6">
																{!! Form::text('name', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('email', trans('profile.email'), ['class'=>'control-label col-md-3']) !!}
															<div class="col-md-6">
																{!! Form::text('email', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('city', trans('profile.city'), ['class'=>'control-label col-md-3']) !!}
															<div class="col-md-6">
																{!! Form::text('city', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('message', trans('profile.message'), ['class'=>'control-label col-md-3']) !!}
															<div class="col-md-6">
																{!! Form::textarea('message', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label(' ',  ' ', ['class'=>'control-label col-md-3']) !!}
															<div class="col-md-6">
																<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('layout.send') }}</button>
															</div>
														</div>
											{!! Form::close() !!}
								</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section end -->

@endsection

@section('js')
		
		<script src="{{ asset('plugins/jquery.parallax-1.1.3.js') }}"></script>
		<!-- Isotope javascript -->
		<script type="text/javascript" src="{{ asset('plugins/isotope/isotope.pkgd.min.js') }}"></script>
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
						
@endsection
						