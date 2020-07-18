@extends('layouts/master')
@section('title')Tech Tutorials for The Elects - Donzoby.com
@stop

@section('displayImage')
	@parent
@endsection

@section('mainContent')
<div class='container-fluid' id='main-content'>
	<div class="row">
    <div class = "col-lg-2" id="left-nav">
			@include('layouts.left-nav')
    </div>
    <div class = "col-lg-7" id="center-col">
            <!-- <h1>Welcome to DTech where we do tech with conscience!</h1> -->



    <div class="card-deck"><!------------------------Web design card-deck begins ------------------------------>
      <div class="card-body">
		<h4 class="card-title "><a href="{{ url('/web-design/') }}">	Learn Web Design</a></h4>
		<div class="card-links">
			<a href="{{ url('/web-design/html') }}">HTML</a>
			<a href="{{ url('/web-design/css') }}">CSS</a>
			<a href="{{ url('/web-design/javascript') }}">JavaScript</a>
			<a href="{{ url('/web-design/jQuery') }}">jQuery</a>
		</div> <hr>
		<div class="row">
			<img class="col-sm-4" src="{{asset('images/dzb-web-design.png')}}" alt="Card image">
		    <p class="col-sm-8 card-text">Our web design course/tutorials are focused on those programming/scripting languages (e.g html, css etc) mainly used on the client side (browsers) to layout, format and animate the front end of web applications.</p>
		</div>
      </div>
      <!-- <div class="card-footer">
      	Today’s Top Read:<span class="featured"> Simplified HTML5 Form</span>
      	<span class="float-right">Latest Addition:<span class="featured float-right"> Simplified HTML5 Form</span></span>
      </div> -->
	</div>

	<div class="card-deck"><!---------------------------Graphics card-deck begins ------------------------------->
      <div class="card-body">
		<h4 class="card-title "><a href="{{ url('/graphics/') }}">Start Learning Graphics</a></h4>
		<div class="card-links">
			<a href="{{ url('graphics/coreldraw') }}">CorelDraw</a>
			<a href="{{ url('graphics/photoshop') }}">Photoshop</a>
			<a href="{{ url('graphics/gimp') }}">Gimp</a>
		</div> <hr>
		<div class="row">
			<img class="col-sm-4" src="{{asset('images/dzb-graphics.png')}}" alt="Card image">
		    <p class="col-sm-8 card-text">The ability to work with graphics/images to at least a minimal extent is a good and needed skill for efficiency in computer usage. Currently we are covering three Graphics applications which are broadly used for two types of graphics – bitmap images and vector graphics.</p>
		</div>
      </div>
      <!-- <div class="card-footer">
      	Today’s Top Read:<span class="featured"> Simplified HTML5 Form</span>
      	<span class="float-right">Latest Addition:<span class="featured float-right"> Simplified HTML5 Form</span></span>
      </div> -->
	</div>   <!-------------------------------- ends card-deck --------------------------------->

	<div class="card-deck"><!-------------------------mobile-app card-deck begins ----------------------------->
      <div class="card-body">
		<h4 class="card-title "><a href="{{ url('/web-dev') }}">Start Server Development</h4></a>
		<div class="card-links">
			<a href="{{ url('/server-dev/php') }}">PHP</a>
			<a href="{{ url('/server-dev/sql') }}">SQL</a>
			<a href="{{ url('/server-dev/mysql') }}">MySQL</a>
			<a href="{{ url('/server-dev/laravel') }}">Laravel</a>
			<!-- <a href="{{ url('/mobile-app-dev/iOS-swift') }}">iOS: Swift</a> -->
		</div> <hr>
		<div class="row">
			<img class="col-sm-4" src="{{asset('images/dzb-web-dev.png')}}" alt="Card image">
		    <p class="col-sm-8 card-text">If you want to build something beyond static web pages, if you want to build website that can receive user's input and serve a talored content, then you need to learn how to talk to the server. Start learning server side programming for websites and manage website data using databases and much more.</p>
		</div>
      </div>
      <!-- <div class="card-footer">
      	Today’s Top Read:<span class="featured"> Simplified HTML5 Form</span>
      	<span class="float-right">Latest Addition:<span class="featured float-right"> Simplified HTML5 Form</span></span>
      </div> -->
	</div>   <!-------------------------------- ends card-deck --------------------------------->

    </div> <!-------------------------------- ends center column --------------------------------->
    <div class = "col-lg-3" id="right-col">
    	@include('layouts.right-col')
    </div>
	</div>

</div><!--main-content-->
@endsection

@section('bottomLinks')
@endsection
