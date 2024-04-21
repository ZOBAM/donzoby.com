<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image">
    @isset($course)
        @if ($subject == '')
            <h1>{{ strtoupper($course) }}</h1>
            {{-- @include('courses/' . $course) --}}
        @endif
    @endisset
</x-app-layout>
