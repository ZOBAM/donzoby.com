<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="tw-flex tw-flex-col md:tw-flex-row tw-p-8">
            <div class="left-front-end tw-w-full md:tw-w-4/5">
                <h2>Front End</h2>
                <p>
                    Our front-end course/tutorials are focused on those programming/scripting languages (e.g html, css etc) mainly used on the client side (browsers) to layout, format and animate the front end of web applications.
                </p>
                <div class="tw-p-8 tw-flex tw-flex-col md:tw-flex-row tw-justify-around tw-bg-gradient-to-tr tw-from-slate-300 tw-to-gray-100">
                    <div class="">
                        <ul class="tw-font-bold">
                            <li class="tw-p-2">Introduction to JavaScript</li>
                            <li class="tw-p-2">Say Hello in JavaScript</li>
                            <li class="tw-p-2">Introduction to JavaScript</li>
                            <li class="tw-p-2">Say Hello in JavaScript</li>
                        </ul>
                    </div>
                    <div class="">
                        <button class="tw-block tw-p-2 tw-bg-blue-400 tw-rounded-md tw-text-white tw-my-2">Learn HTML</button>
                        <button class="tw-block tw-p-2 tw-bg-blue-400 tw-rounded-md tw-text-white tw-my-2">Learn CSS</button>
                        <button class="tw-block tw-p-2 tw-bg-blue-400 tw-rounded-md tw-text-white tw-my-2">Learn JAVASCRIPT</button>
                        <button class="tw-block tw-p-2 tw-bg-blue-400 tw-rounded-md tw-text-white tw-my-2">Learn Vue JS</button>
                    </div>
                </div>
            </div>
            <div class="right-front-end tw-w-full md:tw-w-1/5 tw-bg-blue-200">
                <p>
                    The right side comes here soonest.
                </p>
            </div>
        </section>
        <section></section>
        <section></section>
    </div>
</x-app-layout>