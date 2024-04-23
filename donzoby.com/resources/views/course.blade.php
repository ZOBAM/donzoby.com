<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image">
    @isset($course)
        <h1 class="text-center tw-bg-gray-100 tw-p-2 tw-my-2 tw-font-bold">{{ strtoupper($course->name) }}</h1>
        {!! $course->long_description !!}
        @foreach ($course->subjects as $subject)
            <h3 class="tw-mt-4">
                <a href="/{{ $subject->course->slug }}/{{ $subject->slug }}">{{ $subject->name }}</a>
                {{-- {{ $subject->name }} --}}
            </h3>
            <p>
                {{ $subject->description }} <a href="/{{ $subject->course->slug }}/{{ $subject->slug }}">Start Learning
                    {{ $subject->name }}</a>
            </p>
        @endforeach
    @endisset
</x-app-layout>
