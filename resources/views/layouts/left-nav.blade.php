
        <a href="/mobile-usage/service-providers/data-plans" style="color: #00ADEF;">
    <div style="background-color: #B8B8B8; margin-bottom: 0.4em; text-align: center;border-radius: 0.3em;">
            <span style="width: 96%; border: 0.25em solid #dfe0e0;border-radius: 0.3em; margin: 0.2em auto; display:inline-block; background-color: white; line-height: 1.5em; font-weight: bolder; font-size: larger;"> Consolidated Data Plans in Nigeria
            <span style="font-size: small; font-family: monospace; color: rgb(12, 17, 2);"><br> All Plans in One Place</span>
        </span>
    </div>
        </a>
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
