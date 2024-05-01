<x-single_col title="Login">
    <div id="login" class="tw-my-10 tw-p-4 tw-rounded-md tw-shadow-lg">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                <label for="email">Email</label>
                <input type="email" id="email" class="tw-block tw-mt-1" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <label for="password">Password</label>
                <input type="password" id="password" class="tw-block tw-mt-1" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="tw-rounded dark:bg-gray-900 tw-border-gray-300 dark:border-gray-700 tw-text-indigo-600 tw-shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="tw-ms-2 tw-text-sm tw-text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="tw-flex tw-items-center tw-justify-around tw-mt-4">
                @if (Route::has('password.request'))
                    <a class="tw-underline tw-text-sm tw-text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 tw-rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button class="btn btn-primary tw-px-4 tw-font-semibold">Log in</button>
            </div>
        </form>
    </div>
</x-single_col>
