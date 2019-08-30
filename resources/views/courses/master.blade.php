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

     @isset($subject)
        @if($subject!='')
        	@isset($subject_data)
        		@if($subject_data!=false)
        <div id="bread-comb">
        	<i class="fas fa-location-arrow"></i>
        	<a href="/">Home</a> <i class="fa fa-angle-double-right"></i>
        	<a href="/{{$course}}">{{ucwords(str_replace('-',' ',$course))}}</a> <i class="fa fa-angle-double-right"></i>
        	{{ucwords(str_replace('-',' ',$subject))}}
        </div>
        			@foreach($subject_data as $subject_topic)
        			<a href="{{ url('/'.$course.'/'.$subject.'/'.$subject_topic->id.'/'.$subject_topic->post_topic) }}">{{$subject_topic->post_topic}}</a><hr>
        			@endforeach
        		@else
        			<h3>Tutorials on {{$subject}} is coming soon. <br> Please check back.</h3>
        		@endif
        	@endisset
        	@isset($topic)
        	<div id="bread-comb">
        	<i class="fas fa-location-arrow"></i>
        	<a href="/">Home</a> <i class="fa fa-angle-double-right"></i>
        	<a href="/{{str_replace(' ','-',$topic->course)}}">{{ucwords($topic->course)}}</a> <i class="fa fa-angle-double-right"></i>
        	<a href="/{{str_replace(' ','-',$topic->course)}}/{{str_replace(' ','-',strtolower($topic->subject))}}">{{$topic->subject}}</a> <i class="fa fa-angle-double-right"></i>
        	{{$topic->post_topic}}
        	</div>
        		<h1 id="topic">{{$topic->post_topic}}</h1>
        		<div id="post-details">
	        		<span>Last Update: {{date("M d, Y",strtotime($topic->updated_at))}}</span><span class="float-right"><i class="fa fa-eye"></i> {{$topic->post_hits}} times.</span>
	        	</div>
	        	<div id="post-content">
	        		{!! $topic->post_content !!}
	        	</div>
        		

<!-- -------------------------- Facebook Share button ---------------------- -->
<!-- -------------------------- Facebook Share button ---------------------- -->
<!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your share button code -->
<div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

<!-- -------------------------- display  comment ---------------------- -->
<!-- -------------------------- display  comment ---------------------- -->
        		<div class="card">
                <div class="card-header"><i class="fa fa-comments"></i> {{$topic->post_topic}} <span class="float-right">{{ count($comments) }} Comments</span></div>

                <div class="card-body">
                	<!-- {{$comments}} -->
                	@foreach($comments as $comment)
                	<div class="row">
                	<div class="col-sm-12" style="background-color: #EFF1EF;border-top: 4px solid #BDC6BD">
                		By {{$comment->author_name}} On {{date("M d, Y",strtotime($comment->created_at))}}
                	</div>
                	<div class="col-sm-2" style="margin: 5px 0px"> 
                		<img src="{{$comment->author_image_link}}" style="max-width: 50px"> 
                	</div>
                	<div class="col-sm-10" style="margin: 5px 0px"> 
                		{{$comment->comment_content}}
                	</div>
                	<div class="col-sm-12" style="border-top: 4px solid #EFF1EF">
                		<a href=""><i class="col-sm-4 fa fa-thumbs-up"></i></a>
                		@isset(Auth::user()->id)
                		@if($comment->user_id == Auth::user()->id) 
                		<a href="{{ url('comment/'.$comment->id.'/edit') }}" class="col-sm-4">Edit</a>	
                		<a href="{{ url('comment/'.$comment->id.'/delete') }}" class="col-sm-4">Delete</a>
                		@endif 
                		@endisset
                	</div>
                	</div>
                	@endforeach
	            </div>
	            </div>
<!-- -------------------------- display form for logged in user to write new comment ---------------------- -->
<!-- -------------------------- display form for logged in user to write new comment ---------------------- -->
        		@guest
        			<i class="fas fa-pencil-square"></i><a href="{{ url('register') }}" class="align-middle">Register</a> or 
                <a class="" href="{{ url('login') }}">Login</a> to write comments.
        		@else

	                <?php 
	                	$button_text = session()->has('comment_content')? "Update Comment" : "Submit Comment";
	                	$head_text = session()->has('comment_content')? "Edit a Comment" : "Write a Comment";
	                	$form_action = session()->has('comment_content')? url('comment/'.$comment->id.'/update') : url('comment/'.$topic->id);
	                 ?>

        		<div class="card">
	                <div class="card-header"><i class="fa fa-comment"></i> {{Auth::user()->name}} <span class="float-right">{{ $head_text }}</span></div>

	                <div class="card-body">

	                    <form method="POST" id="comment" action="{{ $form_action }}" enctype="multipart/form-data">
	                        {{ csrf_field() }}

	                        <div class="form-group row">
	                            <div class="col-sm-12">
	                                <textarea id="comment_content" placeholder="Write comment here." class="form-control{{ $errors->has('comment_content') ? ' is-invalid' : '' }}" name="comment_content" required >{{session()->has('comment_content')?Session::get('comment_content'):old('comment_content')}}</textarea>
	                            @if ($errors->has('comment_content'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('comment_content') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-sm-6 offset-sm-4">
	                                <button type="submit" class="btn btn-primary">
	                                    {{ $button_text }}
	                                </button>
	                            </div>
	                        </div>


		                    </form>
		                </div>
	            </div>
				@endguest
        	@endisset
	@endif
	@endisset

	@isset($course)
		@if($subject=='')
		<h1>{{strtoupper($course) }}</h1>
		@include('courses/'.$course)
		@endif
	@endisset


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
