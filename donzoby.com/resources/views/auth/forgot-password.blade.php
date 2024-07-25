<x-single_col title="Login">
    <div id="login" class="tw-my-10 tw-p-4 tw-rounded-md tw-shadow-lg">
        <div class="tw-mb-4 tw-text-sm tw-text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="tw-mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email"
                    value="{{ old('email') }}" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>

            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <button class="btn btn-primary">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-single_col>
