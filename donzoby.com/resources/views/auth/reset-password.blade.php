<x-single_col title="Login">
    <div id="login" class="tw-my-10 tw-p-4 tw-rounded-md tw-shadow-lg">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email"
                    value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>

            <!-- Password -->
            <div class="tw-mt-4">
                <label for="password">Password</label>
                <input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="tw-mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="tw-mt-4">
                <label for="password_confirmation">Confirm Password</label>

                <input id="password_confirmation" class="tw-block tw-mt-1 tw-w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="tw-mt-2" />
            </div>

            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <button class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</x-single_col>
