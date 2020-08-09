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
        <div class="card text-center">
            <div class="card-header">
                <h4 class="card-title "><a href="{{ url('/front-end/') }}">	Learn Front-end Dev.</a></h4>
            </div>
            <div class="card-body">
                <p class="card-text">Our front-end course/tutorials are focused on those programming/scripting languages (e.g html, css etc) mainly used on the client side (browsers) to layout, format and animate the front end of web applications.</p>
            </div>
            <div>
                <hr>
                <div class="card-links">
                    <a href="{{ url('/front-end/html') }}">HTML</a>
                    <a href="{{ url('/front-end/css') }}">CSS</a>
                    <a href="{{ url('/front-end/javascript') }}">JavaScript</a>
                    <a href="{{ url('/front-end/jQuery') }}">jQuery</a>
                </div>
                <hr>
            </div>
            <div class="card-footer text-muted">
                <span class="float-left">Latest Addition:<span class="featured float-right"> Simplified HTML5 Form</span></span>
            </div>
        </div>

        <div class="card text-center">
            <div class="card-header">
                <h4 class="card-title "><a href="{{ url('/graphics/') }}"> Learn Graphics</a></h4>
            </div>
            <div class="card-body">
                <p class="card-text">The ability to work with graphics/images to at least a minimal extent is a good and needed skill for efficiency in computer usage. Currently we are covering three Graphics applications which are broadly used for two types of graphics – bitmap images and vector graphics.</p>
            </div>
            <div>
                <hr>
                <div class="card-links">
                    <a href="{{ url('graphics/coreldraw') }}">CorelDraw</a>
                    <a href="{{ url('graphics/photoshop') }}">Photoshop</a>
                    <a href="{{ url('graphics/gimp') }}">Gimp</a>
                </div>
                <hr>
            </div>
            <div class="card-footer text-muted">
                <span class="float-left">Latest Addition:<span class="featured float-right"> Simplified HTML5 Form</span></span>
            </div>
        </div><!-------------------------------- ends card-deck --------------------------------->

        <div class="card text-center">
            <div class="card-header">
                <h4 class="card-title "><a href="{{ url('/back-end') }}">Learn Back-end Dev.</h4></a>
            </div>
            <div class="card-body">
                <p class="card-text">If you want to build something beyond static web pages, if you want to build website that can receive user's input and serve a tailored content, then you need to learn how to talk to the server. Start learning server side programming for websites and manage website data using databases and much more.</p>
            </div>
            <div>
                <hr>
                <div class="card-links">
                    <a href="{{ url('/back-end/php') }}">PHP</a>
                    <a href="{{ url('/back-end/sql') }}">SQL</a>
                    <a href="{{ url('/back-end/mysql') }}">MySQL</a>
                    <a href="{{ url('/back-end/laravel') }}">Laravel</a>
                    <!-- <a href="{{ url('/mobile-app-dev/iOS-swift') }}">iOS: Swift</a> -->
                </div>
                <hr>
            </div>
            <div class="card-footer text-muted">
                <span class="float-left">Latest Addition:<span class="featured float-right"> Simplified HTML5 Form</span></span>
            </div>
        </div><!-------------------------------- ends card-deck --------------------------------->

    </div> <!-------------------------------- ends center column --------------------------------->
    <div class = "col-lg-3 text-center" id="right-col">
    	@include('layouts.right-col')
    </div>
	</div>

</div><!--main-content-->
@endsection

@section('bottomLinks')
@endsection
