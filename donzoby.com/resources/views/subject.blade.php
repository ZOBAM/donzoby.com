<x-app-layout :posts="$posts" :listed-subjects="$listed_subjects">
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
                    @foreach ($subject_data as $subject_topic)
                        <a
                            href="{{ url('/' . $course . '/' . $subject . '/' . $subject_topic->id . '/' . $subject_topic->post_topic) }}">{{ $subject_topic->post_topic }}</a>
                        <hr>
                    @endforeach
                @else
                    <h3>Tutorials on {{ $subject }} is coming soon. <br> Please check back.</h3>
                @endif
            @endisset
        @endif
    @endisset
</x-app-layout>
