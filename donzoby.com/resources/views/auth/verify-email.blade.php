<x-single_col title="Verify Email">
    <div id="register" class="tw-my-10 tw-p-4 tw-rounded-md tw-shadow-lg">
        <div class="tw-mb-4 text-sm tw-text-gray-600 dark:text-gray-400">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
        @if (session('status') == 'verification-link-sent')
            <div class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
        <div class="tw-mt-4 tw-flex tw-items-center tw-justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <button class="btn btn-primary">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="tw-underline tw-text-sm tw-text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 tw-rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-single_col>
