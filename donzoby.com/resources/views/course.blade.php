<x-app-layout :posts="$posts" :listed-subjects="$listed_subjects">
    @isset($course)
        @if ($subject == '')
            <h1>{{ strtoupper($course) }}</h1>
            {{-- @include('courses/' . $course) --}}
        @endif
    @endisset
</x-app-layout>
