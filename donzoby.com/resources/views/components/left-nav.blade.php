@isset($posts)
    @foreach ($listedSubjects as $sub)
        <p>{{ $sub }}</p>
        @foreach ($posts as $post)
            @if ($post->subject->name == $sub)
                <a
                    href="{{ url('/' . $post->subject->course->slug . '/' . $post->subject->slug . '/' . $post->id . '/' . str_replace(' ', '-', $post->topic)) }}">{{ $post->topic }}</a>
            @endif
        @endforeach
    @endforeach
@endisset
