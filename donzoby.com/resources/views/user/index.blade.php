<x-user-layout>
    <section x-data='user' class="">
        <div class="user-dp-container tw-flex tw-flex-col tw-justify-center tw-items-center">
            <img @click="selectImage" class="tw-cursor-pointer" :src="avatar"
                alt="{{ $user->first_name }} avatar">
            <span>{{ date('M d, Y', strtotime($user->created_at)) }}</span>
            <input type="file" x-ref="avatar" hidden>
        </div>
        <div class="user-details tw-mt-10">
            {{-- {{ $user }} --}}
            <div class="table-responsive">
                <table class="table table-borderless ">
                    <tr>
                        <td><span>First Name:</span></td>
                        <td>
                            <template x-if="!isEditing"><span x-text="user.first_name"></span></template>
                            <div x-show="isEditing" class="">
                                <input type="text" class="form-control"
                                    :class="hasError.first_name.hasError ? 'is-invalid' : 'is-valid'"
                                    id="validationServer01" x-model="userForm.first_name" required>
                                <div class="invalid-feedback">
                                    <span x-text="hasError.first_name.message"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Last Name:</span></td>
                        <td>
                            <template x-if="!isEditing"><span x-text="user.last_name"></span></template>
                            <div x-show="isEditing" class="">
                                <input type="text" class="form-control"
                                    :class="hasError.last_name.hasError ? 'is-invalid' : 'is-valid'"
                                    id="validationServer01" x-model="userForm.last_name" required>
                                <div class="invalid-feedback">
                                    <span x-text="hasError.last_name.message"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Phone No:</span></td>
                        <td>
                            <template x-if="!isEditing"><span x-text="user.tel"></span></template>
                            <div x-show="isEditing" class="">
                                <input type="text" class="form-control"
                                    :class="hasError.tel.hasError ? 'is-invalid' : 'is-valid'" id="validationServer01"
                                    x-model="userForm.tel" required>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Email:</span></td>
                        <td>
                            <template x-if="!isEditing"><span>{{ $user->email }}</span></template>
                            <div x-show="isEditing" class="">
                                <input type="text" class="form-control" id="validationServer01"
                                    :value="user.email" disabled>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Country:</span></td>
                        <td>
                            <template x-if="!isEditing"><span x-text="user.country"></span></template>
                            <div x-show="isEditing" class="">
                                <input type="text" class="form-control"
                                    :class="hasError.country.hasError ? 'is-invalid' : 'is-valid'"
                                    id="validationServer01" x-model="userForm.country" required>
                                <div class="invalid-feedback">
                                    <span x-text="hasError.country.message"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr x-show="!isEditing">
                        <td><span>Comment Count:</span></td>
                        <td class="comment">{{ $user->comments()->count() }} comments</td>
                    </tr>
                </table>
            </div>
            <button x-show="isEditing" @click="isEditing = false"
                class="btn btn-outline-danger tw-font-bold tw-mt-10">Cancel Edit</button>
            <button @click="edit" class="btn btn-primary tw-font-bold tw-mt-10" :disabled="isEditing && formHasError">
                <i x-show="isEditing && loading" class="fa fa-spinner tw-animate-spin" aria-hidden="true"></i>
                <span x-text="isEditing? 'Save Change' : 'Edit profile'"></span>
            </button>
        </div>
        @include('bs-toast')
    </section>
    <script>
        document.addEventListener('alpine:init', () => {
            // bootstrap toast
            const toastTrigger = document.getElementById('liveToastBtn');
            const toastLiveExample = document.getElementById('liveToast');
            if (toastTrigger) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastTrigger.addEventListener('click', () => {
                    toastBootstrap.show();
                })
            }

            Alpine.data('user', () => ({
                loading: false,
                isEditing: false,
                user: {{ Js::from($user) }},
                userForm: {
                    first_name: '',
                    last_name: '',
                    tel: '',
                    country: '',
                    avatar: null,
                },
                toastMessage: 'Hail Christ',
                validationRules: {
                    first_name: {
                        minLength: 2,
                        maxLength: 25,
                    },
                    last_name: {
                        minLength: 2,
                        maxLength: 25,
                    },
                    tel: {
                        minLength: 9,
                        maxLength: 15,
                    },
                    country: {
                        minLength: 3,
                        maxLength: 25,
                    },
                },

                async init() {
                    this.$refs.avatar.addEventListener('change', (e) => {
                        const imageFile = e.target.files[0];
                        if (imageFile) {
                            this.userForm.avatar = imageFile;
                            const reader = new FileReader();
                            reader.readAsDataURL(imageFile);
                            reader.onload = (e) => {
                                setAvatar(e.target.result);
                            }
                        }
                    });

                    const setAvatar = (avatar) => {
                        this.user.avatar = avatar;
                        console.log(this.userForm);
                    }
                },

                // GETTERS
                get avatar() {
                    return this.userForm.avatar ? this.user.avatar : `/${this.user.avatar}`;
                },
                get hasError() {
                    return this.validateForm();
                },
                get formHasError() {
                    let error = false;
                    for (const field in this.hasError) {
                        if (this.hasError[field].hasError) {
                            error = true;
                            break;
                        }
                    }
                    return error;
                },

                // METHODS
                formatErrorMsg(rules, rule, msg) {
                    let fieldName = rules[rule].hasOwnProperty('name') ? rules[rule].name : rule
                        .replaceAll('_', ' ');
                    // let fieldName = rule.replaceAll('_', ' ');
                    return msg.replaceAll('_', fieldName);
                },
                validateForm() {
                    const rules = this.validationRules;

                    for (let rule in rules) {
                        let field = rules[rule];

                        for (let ruleItem in field) {
                            if (ruleItem === 'maxLength' || ruleItem === 'minLength') {
                                let currentValue = this.userForm[rule]?.length;
                                const isTooShort = currentValue < field['minLength'];
                                const isTooLong = currentValue > field['maxLength'];
                                const isNull = !currentValue;
                                rules[rule]['hasError'] = false;
                                if (isTooShort || isTooLong || isNull) {
                                    rules[rule]['hasError'] = true;
                                    rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                        `_ too short. Min length ${field['minLength']} characters::${currentValue}`
                                    );
                                    if (isTooLong) {
                                        rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                            `_ too long. Max length ${field['maxLength']} characters`
                                        );
                                    }
                                }
                            }
                        }
                    }
                    // console.log(rules);
                    return rules;
                },
                async edit() {
                    if (this.isEditing) {
                        await this.update();
                        return;
                    }
                    this.userForm = {
                        first_name: this.user.first_name,
                        last_name: this.user.last_name,
                        tel: this.user.tel,
                        country: this.user.country,
                        avatar: null,
                    };
                    this.isEditing = true;
                    console.log(this.userForm);
                },
                selectImage() {
                    if (this.isEditing)
                        this.$refs.avatar.click()
                },
                async update() {
                    this.loading = true;
                    try {
                        let formData = new FormData();
                        for (const field in this.userForm) {
                            if (this.userForm[field])
                                formData.append(field, this.userForm[field]);
                        }
                        // form method spoofing
                        formData.append('_method', 'patch');

                        const {
                            data
                        } = await axios.post('/profile', formData);
                        this.user = data.data;
                        console.log(this.user);
                        this.toastMessage = data.message;
                    } catch (error) {
                        console.log('error updating profile:', error);
                        this.toastMessage = "Error updating profile";
                    } finally {
                        this.loading = this.isEditing = false;
                        toastTrigger.click();
                    }
                },
            }));
        });
    </script>
</x-user-layout>
