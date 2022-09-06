
@section('description')
	@isset($description)
		<meta name="description" content="{{$description}}" />
		<meta property="og:image"   content="{{str_replace('https','http',$post_image)}}" />
		<meta property="og:image:url"   content="{{str_replace('https','http',$post_image)}}" />
	@endisset
@endsection

@extends('layouts/master')
@section('title')
	{{$title?? 'Consolidated Data Plans in Nigeria'}} - Donzoby.com
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
            <!-- list specific data plan -->
            @isset($data_plan)
            <div id="bread-comb">
                <i class="fas fa-location-arrow"></i>
                <a href="/">Home</a> <i class="fa fa-angle-double-right"></i>
                <a href="/mobile-usage">Mobile Usage</a> <i class="fa fa-angle-double-right"></i>
                <a href="/mobile-usage/service-providers">Network Providers</a> <i class="fa fa-angle-double-right"></i>
                <a href="/mobile-usage/service-providers/data-plans/">Data Plans</a> <i class="fa fa-angle-double-right"></i>
                {{$data_plan->title}}
        	</div>
            <h1>{{$data_plan->title}}</h1>
            <div id="post-details">
                <span>Last Update: {{date("M d, Y",strtotime($data_plan->updated_at))}}</span><span class="float-right"><i class="fa fa-eye"></i> {{$data_plan->hits}} times.</span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Provider:</th><th>{{strtoupper($data_plan->provider)}}</th>
                    </tr>
                    <tr>
                        <td>Volume:</td><td>{{$data_plan->volume}}</td>
                    </tr>
                    <tr>
                        <td>Validity:</td><td>{{$data_plan->validity}}</td>
                    </tr>
                    <tr>
                        <td>Bonus for all:</td><td>{{$data_plan->bonus_all}}</td>
                    </tr>
                    <tr>
                        <td>Bonus for New Subscribers:</td><td>{{$data_plan->bonus_new_sim}}</td>
                    </tr>
                    <tr>
                        <td>How to subscribe:</td><td>{{$data_plan->how_to_sub}}</td>
                    </tr>
                    <tr>
                        <td>Data Use Period:</td><td>{{$data_plan->use_period}}</td>
                    </tr>
                    <tr>
                        <td>Hits:</td><td>{{$data_plan->hits}} <i class="fa fa-eye"></i></td>
                    </tr>
                    <tr>
                        <td>More info:</td><td>{{$data_plan->description}}</td>
                    </tr>
                </table>
            </div>
            <div class="row" id="relate-plans">
                <div class="col-sm-8 offset-sm-2">
                    <h3 class="text-center">Related Data Plans</h3>
                </div>
                <div class="col-sm-4">
                    <div class="related-children">
                        <span class="data-price">3.5GB<br>2000</span><br>
                        <span>MTN</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="related-children">
                        <span class="data-price">3.5GB<br>2000</span><br>
                        <span>9mobile</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="related-children">
                        <span class="data-price">3.5GB<br>2000</span><br>
                        <span>Glo</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="related-children">
                        <span class="data-price">3.5GB<br>2000</span><br>
                        <span>MTN</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="related-children">
                        <span class="data-price">3.5GB<br>2000</span><br>
                        <span>9mobile</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="related-children">
                        <span class="data-price">3.5GB<br>2000</span><br>
                        <span>Glo</span>
                    </div>
                </div>
            </div>
            @endisset
            <!-- list various data plans -->
            @isset($data_plans)
            <div id="bread-comb">
                <i class="fas fa-location-arrow"></i>
                <a href="/">Home</a> <i class="fa fa-angle-double-right"></i>
                <a href="/mobile-usage">Mobile Usage</a> <i class="fa fa-angle-double-right"></i>
                <a href="/mobile-usage/service-providers">Network Providers</a> <i class="fa fa-angle-double-right"></i>
                <a href="/mobile-usage/service-providers/data-plans/">Data Plans</a> <i class="fa fa-angle-double-right"></i>
        	</div>
			<!-- <h1>Welcome to DTech where we do tech with conscience!</h1> -->
			<h1>Consolidated Data Plans in Nigeria <sub style="font-size: 0.5em;">Donzoby.com</sub> </h1>
            <hr>
            @if(isset($sub_heading))
            <h3 class="text-center">{{$sub_heading}}</h3>
            <ol>
                @foreach($data_plans as $data_plan)
                    <li>
                        <a href="/mobile-usage/service-providers/data-plans/{{$data_plan->id.'/'.$data_plan->title}}">
                        {{$data_plan->title}}
                        </a>
                        <p>{!! $data_plan->data_plan_desc !!}</p>
                    </li>
                @endforeach
            </ol>
            @else
			<p>
				Welcome to the Data Plans page of our website. Here we have decided to ease your pain of finding the data plans of your choice. We did this by presenting the available data plans offered by the major Network Provider here in one place and in a way that you can easily make sense of them all.
			</p>
			<p>
				Navigate through the exhaustive list of all data plans by choosing any of the categorizing links that we have provided such as: hot data plans, plans by Network Providers etc.
			</p>
            <h3>Hot Data Plans</h3>
            <ol>
                @foreach($data_plans['hot'] as $data_plan)
                    <li>
                        <a href="/mobile-usage/service-providers/data-plans/{{$data_plan->id.'/'.$data_plan->link_title}}"> {{$data_plan->title}}</a>
                        <p>{!! $data_plan->data_plan_desc !!}</p>
                    </li>
                @endforeach
            </ol>
            <h3>Data Plans By Validity</h3>
                @foreach($data_plans['validity'] as $data_plan)
                <a href="/mobile-usage/service-providers/data-plans?validity={{$data_plan->validity}}">
                    <p>{{$data_plan->link_validity}} ({{$data_plan->data_plan_count}} data plans)</p>
                </a>
                @endforeach
            <h3>Data Plans By Network Providers</h3>
            @foreach($data_plans['providers'] as $provider)
                <a href="/mobile-usage/service-providers/data-plans?provider={{$provider->provider}}">
                    <p> {{strtoupper($provider->provider)}} ({{$provider->data_plan_count}} data plans)</p>
                </a>
            @endforeach
            <h3>Data Plans By Volume</h3>
            <div style="max-height: 40vh; overflow: auto;">
            @foreach($data_plans['volume'] as $data_plan)
                <a href="/mobile-usage/service-providers/data-plans?volume={{$data_plan->volume}}">
                    <p>{{$data_plan->link_volume}} ({{$data_plan->data_plan_count}} data plans)</p>
                </a>
            @endforeach
            </div>

            @endif
            @endisset
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
