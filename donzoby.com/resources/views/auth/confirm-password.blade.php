<x-single_col title="Confirm Password">
    <div id="login" class="tw-my-10 tw-p-4 tw-rounded-md tw-shadow-lg">
        <div class="tw-mb-4 tw-text-sm tw-text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="tw-mt-2" />
            </div>

            <div class="tw-flex tw-justify-end tw-mt-4">
                <button class="btn btn-primary">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
</x-single_col>
