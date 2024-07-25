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
                            {!! $course->description !!}
                        </p>
                    @endif
                    <div
                        class="post-links tw-flex tw-flex-col md:tw-flex-row tw-justify-around tw-items-center tw-p-4 tw-mt-8">
                        <div class="posts tw-px-6 tw-py-8 tw-rounded-2xl tw-shadow-xl">
                            @foreach ($data as $post)
                                <a href="{{ url('/' . $post->subject->course->slug . '/' . $post->subject->slug . '/' . $post->slug) }}"
                                    class="">{{ $post->topic }}</a>
                            @endforeach
                        </div>
                        <div class="buttons tw-px-6 tw-py-8">
                            @foreach ($subjects as $subject)
                                <a href="{{ url('/' . $subject->course->slug . '/' . $subject->slug) }}" class=""
                                    style="padding: 0px">
                                    <button class="">Learn {{ $subject->name }}</button>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tw-px-4 -tw-mt-4">
                    {{-- <hr> --}}
                    <div class="card-links tw-flex tw-justify-between tw-text-sm">
                        <span class="tw-text-gray-500">Latest: </span>
                        <span class=""><a
                                href="{{ url('/' . $latest_modified[$course_slug]->subject->course->slug . '/' . $latest_modified[$course_slug]->subject->slug . '/' . $latest_modified[$course_slug]->slug) }}">{{ $latest_modified[$course_slug]->topic }}</a>
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
