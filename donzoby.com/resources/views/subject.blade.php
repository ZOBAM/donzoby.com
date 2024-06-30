<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image">
    @isset($subject)
        <div id="bread-comb">
            <i class="fas fa-location-arrow"></i>
            <a href="/">Home</a> <i class="fas fa-angle-double-right"></i>
            <a href="/{{ $course }}">{{ ucwords(str_replace('-', ' ', $course)) }}</a> <i
                class="fas fa-angle-double-right"></i>
            {{ ucwords(str_replace('-', ' ', $subject->name)) }}
        </div>
        <h1 class="text-center tw-bg-gray-100 tw-p-2 tw-mt-2 tw-font-bold">{{ $subject->name }}</h1>
        <p class="tw-mt-4">{{ $subject->description }}</p>
        @if (count($subject->posts))
            @foreach ($subject->posts as $post)
                @if ($post->status == 'published')
                    <div class="tw-mt-4">
                        <a class=""
                            href="{{ url('/' . $course . '/' . $subject->slug . '/' . $post->slug) }}">{{ $post->topic }}</a>
                        <p class="tw-pb-2">{{ $post->description }}</p>
                        <hr style="opacity: 0.15">
                    </div>
                @endif
            @endforeach
        @else
            <h3>Tutorials on {{ $subject->name }} is coming soon. <br> Please check back.</h3>
        @endif
    @endisset
</x-app-layout>
