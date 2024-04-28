@isset($posts)
    @foreach ($listedSubjects as $sub)
        <h3>{{ $sub }}</h3>
        <div class="">
            @foreach ($posts as $post)
                @if ($post->subject->name == $sub)
                    <a
                        href="{{ url('/' . $post->subject->course->slug . '/' . $post->subject->slug . '/' . $post->id . '/' . str_replace(' ', '-', $post->topic)) }}">{{ $post->topic }}</a>
                    @if (count($post->children))
                        @foreach ($post->children as $child_post)
                            <a class="tw-ml-3" style="box-shadow: -2px 0px 1px rgb(200, 198, 218)"
                                href="{{ url('/' . $child_post->subject->course->slug . '/' . $child_post->subject->slug . '/' . $child_post->id . '/' . str_replace(' ', '-', $child_post->topic)) }}">{{ $child_post->topic }}</a>
                        @endforeach
                    @endif
                @endif
            @endforeach
        </div>
    @endforeach
@endisset
