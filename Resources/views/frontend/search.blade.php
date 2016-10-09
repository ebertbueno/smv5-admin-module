@extends('theme.layout')

@section('content')


			<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">

				<div class="container">
					<div class="row">
						<div class="col-md-12">

								<h2>{{ trans('home.search.title') }} {{ Request::segment(2) }}</h2>
								<div class="separator-2"></div>
								<p>{{ trans('home.search.desc') }} </p>
								<div class="space-bottom"></div>
								<div class="col-md-12">
											@include('site.petition_slider', $petitions )
								</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section end -->

@endsection

@section('js')
		
		<!-- Parallax javascript -->
		<script src="{{ asset('plugins/jquery.parallax-1.1.3.js') }}"></script>
		<!-- Isotope javascript -->
		<script type="text/javascript" src="{{ asset('plugins/isotope/isotope.pkgd.min.js') }}"></script>
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

@endsection

@section('script')
	$(document).ready(function(){
			
	})
@endsection