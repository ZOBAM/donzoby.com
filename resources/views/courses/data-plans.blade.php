
@section('description')
	@isset($description)
		<meta name="description" content="{{$description}}" />
		<meta property="og:image"   content="{{str_replace('https','http',$post_image)}}" />
		<meta property="og:image:url"   content="{{str_replace('https','http',$post_image)}}" />
	@endisset
@endsection

@extends('layouts/master')
@section('title')
	@isset($title)
		{{$title}} - Donzoby.com
	@endisset
@stop

@section('displayImage')
	@parent
@endsection

@section('mainContent')
<div class='container-fluid' id='main-content'>
	<div class="row">
		<div class = "col-sm-2" id="left-nav">
				@include('layouts.left-nav')
		</div>
		<div class = "col-sm-7" id="center-col">
			<!-- <h1>Welcome to DTech where we do tech with conscience!</h1> -->
			<h1>Consolidated Data Plans in Nigeria <sub style="font-size: 0.5em;">Donzoby.com</sub> </h1>
			<hr>
			<p>
				Welcome to the Data Plans page of our website. Here we have decided to ease your pain of finding the data plans of your choice. We did this by presenting the available data plans offered by the major Network Provider here in one place and in a way that you can easily make sense of them all.
			</p>
			<p>
				Navigate through the exhaustive list of all data plans by choosing any of the categorizing links that we have provided such as: hot data plans, plans by Network Providers etc.
			</p>
			<h3>Hot Data Plans</h3>
			@foreach($data_plans as $data_plan)
			<p>{{$data_plan->title}}</p>
			@endforeach
			<h3>Data Plans By Validity Period</h3>
			@foreach($data_plans as $data_plan)
			<p>{{$data_plan->validity}}</p>
			@endforeach
			<h3>Data Plans By Network Providers</h3>
			@foreach($data_plans as $data_plan)
			<p>{{$data_plan->provider}}</p>
			@endforeach
			<h3>Data Plans By Volume</h3>
			@foreach($data_plans as $data_plan)
			<p>{{$data_plan->volume}}</p>
			@endforeach
			<!-- -------------------------- Facebook Share button ---------------------- -->
			<!-- -------------------------- Facebook Share button ---------------------- -->
			<!-- Load Facebook SDK for JavaScript -->
			<div id="fb-root"></div>
			<script>
				(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>

			<!-- Your share button code -->
			<div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

		</div> <!-- ------------------------------ ends center column ------------------------------- -->
		<div class = "col-sm-3" id="right-col">
			@include('layouts.right-col')
		</div>
	</div>

</div><!--main-content-->
@endsection

@section('bottomLinks')

<!-- -------------------------- Facebook Share script ---------------------- -->
<!-- -------------------------- Facebook Share script ---------------------- -->

@endsection
