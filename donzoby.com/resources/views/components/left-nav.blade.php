@isset($posts)
    @foreach ($listedSubjects as $sub)
        <p>{{ $sub }}</p>
        @foreach ($posts as $post)
            @if ($post->subject == $sub)
                <a
                    href="{{ url('/' . str_replace(' ', '-', $post->course) . '/' . str_replace(' ', '-', strtolower($post->subject)) . '/' . $post->id . '/' . str_replace(' ', '-', $post->post_topic)) }}">{{ $post->post_topic }}</a>
            @endif
        @endforeach
    @endforeach
@endisset
