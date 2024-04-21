<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image">
    @isset($subject)
        @if ($subject != '')
            @isset($subject_data)
                @if ($subject_data != false)
                    <div id="bread-comb">
                        <i class="fas fa-location-arrow"></i>
                        <a href="/">Home</a> <i class="fas fa-angle-double-right"></i>
                        <a href="/{{ $course }}">{{ ucwords(str_replace('-', ' ', $course)) }}</a> <i
                            class="fas fa-angle-double-right"></i>
                        {{ ucwords(str_replace('-', ' ', $subject)) }}
                    </div>
                    @foreach ($subject_data as $post)
                        <a
                            href="{{ url('/' . $course . '/' . $subject . '/' . $post->id . '/' . $post->topic) }}">{{ $post->topic }}</a>
                        <hr>
                    @endforeach
                @else
                    <h3>Tutorials on {{ $subject }} is coming soon. <br> Please check back.</h3>
                @endif
            @endisset
        @endif
    @endisset
</x-app-layout>
