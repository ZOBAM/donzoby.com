<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image" customStyle="home">
    <div id="home" class="tw-mt-4">
        @foreach ($latest as $course_slug => $data)
            @php
                $course = $data[0]->subject->course;
                $subjects = $course->subjects;
            @endphp
            <div class="card tw-mb-24 tw-pb-2">
                <div class="card-header">
                    <h1 class="card-title "><a href="{{ url('/front-end/') }}">
                            {{ $course->name }}</a>
                    </h1>
                </div>
                <div class="card-body">
                    @if ($course->long_description)
                        {!! $course->long_description !!}
                    @else
                        <p class="card-text">
                            Our front-end course/tutorials are focused on those
                            programming/scripting languages (e.g html, css etc) mainly used on the client side
                            (browsers)
                            to layout, format and animate the front end of web applications.</p>
                    @endif
                    <div
                        class="post-links tw-flex tw-flex-col md:tw-flex-row tw-justify-around tw-items-center tw-p-4 tw-mt-8">
                        <div class="posts tw-px-6 tw-py-8 tw-rounded-2xl tw-shadow-xl">
                            @foreach ($data as $post)
                                <a href="" class="">{{ $post->topic }}</a>
                            @endforeach
                            {{-- <a href="" class="">Say Hello in JavaScript</a>
                            <a href="" class="">Introduction to JavaScript</a>
                            <a href="" class="">Say Hello in JavaScript</a>
                            <a href="" class="">Introduction to JavaScript</a>
                            <a href="" class="">Say Hello in JavaScript</a> --}}
                        </div>
                        <div class="buttons tw-px-6 tw-py-8">
                            @foreach ($subjects as $subject)
                                <button class="">Learn {{ $subject->name }}</button>
                            @endforeach
                            {{-- <button class="">Learn CSS</button>
                            <button class="">Learn JAVASCRIPT</button>
                            <button class="">Learn CSS</button> --}}
                        </div>
                    </div>
                </div>
                <div class="tw-px-4 -tw-mt-4">
                    {{-- <hr> --}}
                    <div class="card-links tw-flex tw-justify-between tw-text-sm">
                        <span class="tw-text-gray-500">Latest: </span>
                        <span class=""><a
                                href="{{ url('/front-end/jQuery') }}">{{ $latest_modified[$course_slug]->topic }}</a>
                            <span class="tw-text-xs">
                                &#9001;updated
                                {{ date('M d, Y', strtotime($latest_modified[$course_slug]->updated_at)) }}&#x3009;
                            </span> </span>
                    </div>
                    {{-- <hr> --}}
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
