<x-single_col title="Register">
    <div x-data="register" id="register" class="tw-my-10 tw-p-4 tw-rounded-md tw-shadow-lg">
        <form method="POST" class="form" action="{{ route('register') }}">
            @csrf
            <!-- First Name -->
            <div>
                <label for="first_name">First Name</label>
                <input id="first_name" class="tw-block tw-mt-1 tw-w-full" type="text" name="first_name"
                    value="{{ old('first_name') }}" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="tw-mt-2" />
            </div>
            <!-- Last Name -->
            <div class="tw-mt-4">
                <label for="last_name">Last Name</label>
                <input id="last_name" class="tw-block tw-mt-1 tw-w-full" type="text" name="last_name"
                    value="{{ old('last_name') }}" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="tw-mt-2" />
            </div>
            <!-- Email Address -->
            <div class="tw-mt-4">
                <label for="email">Email</label>
                <input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email"
                    value="{{ old('email') }}" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>
            <!-- Password -->
            <div class="tw-mt-4">
                <label for="password">Password</label>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="tw-block tw-mt-1 tw-w-full" type="password"
                    name="password_confirmation" required autocomplete="password_confirmation" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="tw-mt-2" />
            </div>
            <!-- Country -->
            <div class="tw-mt-4">
                <label for="country">Country</label>
                <input list="country" class="tw-block tw-mt-1 tw-w-full" type="text" name="country"
                    value="{{ old('country') }}" required autofocus autocomplete="country" />
                <datalist id="country">
                    <template x-for="country in allCountries">
                        <option :value="country.name">
                    </template>
                </datalist>
                <x-input-error :messages="$errors->get('country')" class="tw-mt-2" />
            </div>
            <!-- recaptcha -->
            <div class="form-group tw-mt-4">
                <div class="g-recaptcha" data-sitekey="6Lel4Z4UAAAAAOa8LO1Q9mqKRUiMYl_00o5mXJrR"></div>
                <span x-show="!passedRecaptcha && checkedRecaptcha" class="tw-text-xs tw-text-red-500"
                    id="recaptcha_error">Please, verify
                    that you are
                    human.</span>
            </div>

            <div class="tw-flex tw-items-center tw-justify-around tw-mt-4">
                <a class="tw-underline tw-text-sm tw-text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 tw-rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <button id="register-btn" class="btn btn-primary tw-px-5" disabled="false">Register</button>
            </div>
        </form>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.data('register', () => ({
                passedRecaptcha: false,
                checkedRecaptcha: false,
                allCountries: null,

                async init() {
                    // remove the disabled attribute from the submit btn
                    document.getElementById('register-btn').removeAttribute("disabled");

                    // fetch countries from beezlinq
                    try {
                        const {
                            data
                        } = await axios.get("https://api.beezlinq.com/api/v1/get/countries");
                        this.allCountries = data.data;
                    } catch (error) {
                        console.log('error fetching countries', error);
                    }

                    document.querySelector(".form").addEventListener("submit", (event) => {
                        console.log('checking validity of recaptcha');
                        const response = grecaptcha.getResponse();
                        if (response.length === 0) {
                            event.preventDefault();
                            this.passedRecaptcha = false;
                        } else {
                            this.passedRecaptcha = true;
                            document.getElementById('register-btn').setAttribute("disabled",
                                true);
                        }
                        this.checkedRecaptcha = true;
                        setTimeout(() => {
                            this.checkedRecaptcha = false;
                        }, 2000);
                    })
                },

                // GETTERS

                // METHODS
            }));
        });
    </script>
</x-single_col>
