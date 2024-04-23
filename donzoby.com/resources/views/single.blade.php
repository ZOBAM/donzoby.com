<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image" customStyle="single">

    <section id="single">
        @isset($topic)
            <div id="bread-comb" class="tw-pl-2">
                <i class="fas fa-location-arrow"></i>
                <a href="/">Home</a> <i class="fas fa-angle-double-right"></i>
                <a href="/{{ $topic->subject->course->slug }}">{{ ucwords($topic->subject->course->name) }}</a> <i
                    class="fa fa-angle-double-right"></i>
                <a href="/{{ $topic->subject->course->slug }}/{{ $topic->subject->slug }}">{{ $topic->subject->name }}</a>
                <i class="fa fa-angle-double-right"></i>
                {{ $topic->topic }}
            </div>
            <h1 id="topic" class="pb-2">{{ $topic->topic }}</h1>
            <div id="post-details" class="mb-4 tw-pl-2">
                <span>Last Update: {{ date('M d, Y', strtotime($topic->updated_at)) }}</span>
                <span class="tw-float-right">
                    <i class="fa fa-eye"></i> {{ $topic->hits }} times.
                </span>
            </div>
            <div id="post-content" class="tw-pl-2">
                {!! $topic->content !!}
            </div>
            <!-- -------------------------- Facebook Share button ---------------------- -->
            <!-- -------------------------- Facebook Share button ---------------------- -->
            <!-- Load Facebook SDK for JavaScript -->
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <!-- Your share button code -->
            <div class="fb-share-button tw-ml-2" data-href="{{ url()->current() }}" data-layout="button_count"
                data-size="large" data-mobile-iframe="true"><a target="_blank"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&amp;src=sdkpreparse"
                    class="fb-xfbml-parse-ignore">Share</a></div>
            <!-- -------------------------- display  comment ---------------------- -->
            <!-- -------------------------- display  comment ---------------------- -->
            <div class="card mt-5">
                <div class="card-header"><i class="fa fa-comments"></i> {{ $topic->post_topic }} <span
                        class="float-right">{{ count($comments) }} Comments</span></div>
                <div class="card-body">
                    <!-- {{ $comments }} -->
                    @foreach ($comments as $comment)
                        <div class="row">
                            <div class="col-sm-12" style="background-color: #EFF1EF;border-top: 4px solid #BDC6BD">
                                By {{ $comment->author_name }} On {{ date('M d, Y', strtotime($comment->created_at)) }}
                            </div>
                            <div class="col-sm-2" style="margin: 5px 0px">
                                <img src="{{ $comment->author_image_link }}" style="max-width: 50px">
                            </div>
                            <div class="col-sm-10" style="margin: 5px 0px">
                                {{ $comment->content }}
                            </div>
                            <div class="col-sm-12" style="border-top: 4px solid #EFF1EF">
                                <a href=""><i class="col-sm-4 fa fa-thumbs-up"></i></a>
                                @isset(Auth::user()->id)
                                    @if ($comment->user_id == Auth::user()->id)
                                        <a href="{{ url('comment/' . $comment->id . '/edit') }}" class="col-sm-4">Edit</a>
                                        <a href="{{ url('comment/' . $comment->id . '/delete') }}" class="col-sm-4">Delete</a>
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
                $button_text = session()->has('comment_content') ? 'Update Comment' : 'Submit Comment';
                $head_text = session()->has('comment_content') ? 'Edit a Comment' : 'Write a Comment';
                $form_action = session()->has('comment_content') ? url('comment/' . $comment->id . '/update') : url('comment/' . $topic->id);
                ?>
                <div class="card">
                    <div class="card-header"><i class="fa fa-comment"></i> {{ Auth::user()->name }} <span
                            class="float-right">{{ $head_text }}</span></div>
                    <div class="card-body">
                        <form method="POST" id="comment" action="{{ $form_action }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <textarea id="comment_content" placeholder="Write comment here."
                                        class="form-control{{ $errors->has('comment_content') ? ' is-invalid' : '' }}" name="comment_content" required>{{ session()->has('comment_content') ? Session::get('comment_content') : old('comment_content') }}</textarea>
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
    </section>
</x-app-layout>
