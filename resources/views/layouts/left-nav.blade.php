
	@isset($posts)
		@foreach($listed_subjects as $sub)
			<p>{{$sub}}</p>
			@foreach($posts as $post)
				@if($post->subject == $sub)
				<a href="{{ url('/'.str_replace(' ','-',$post->course).'/'.str_replace(' ','-',strtolower($post->subject)) .'/'.$post->id.'/'.str_replace(' ','-',$post->post_topic)) }}">{{$post->post_topic}}</a>
				@endif
			@endforeach
		@endforeach
	@endisset
<div id="courses-list-wrapper" style="background-color: grey;">
	<div id="courses-list">
		<h5>List of Courses</h5>
		<a href="/graphics"><i class="fa fa-angle-right"></i> Graphics</a>
		<a href="/web-design"><i class="fa fa-angle-right"></i> Web Design</a>
		<a href="/server-dev"><i class="fa fa-angle-right"></i> Server Dev.</a>
		<a href="/mobile-app-dev"><i class="fa fa-angle-right"></i> Mobile App Dev.</a>
		<a href="/windows-dev"><i class="fa fa-angle-right"></i> Windows Dev.</a>
		<a href="/msoffice"><i class="fa fa-angle-right"></i> MS Office</a>
		<a href="/office-operations"><i class="fa fa-angle-right"></i> Office Operations</a>
		<a href="/internet-usage"><i class="fa fa-angle-right"></i> Internet Usage</a>
		<a href="/mobile-usage"><i class="fa fa-angle-right"></i> Mobile Usage</a>
	</div>
</div>