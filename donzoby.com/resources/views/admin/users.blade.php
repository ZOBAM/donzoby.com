<x-user-layout>
    <section x-data='users'>
        {{-- Display Delete notification --}}
        @if (session()->has('success_message'))
            <div class="alert alert-success" role="alert">
                <h3>{{ session('success_message') }}</h3>
            </div>
        @endif
        @if (session()->has('error_message'))
            <div class="alert alert-danger" role="alert">
                <h3> {{ session('error_message') }}</h3>
            </div>
        @endif
        <h1 class="text-center">All Users</h1>
        @if (count($users) > 0)
            <?php
            $pageNo = 0;
            if (isset($_GET['page'])) {
                $pageNo = $_GET['page'] - 1;
            }
            $nos = 1;
            ?>
            <div class="table-responsive">
                <table class="table">
                    <?php ?> <!-- initiate no for numbering the list -->
                    <tr>
                        <th colspan="7" class="text-center"><i class="fa fa-home" style="color: green"></i> List of all
                            users<sup>({{ $users->total() }})</sup></th>
                    </tr>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Comment Count</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $pageNo * 10 + $nos++ }}</td>
                            <td>
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </td>
                            <td>
                                {{ $user->email }} <br>
                                @if ($user->email_verified_at)
                                    <span class="badge text-bg-success">verified</span>
                                @else
                                    <span class="badge text-bg-secondary">unverified</span>
                                @endif
                            </td>
                            <td>
                                {{ $user->status }}
                            </td>
                            <td>{{ $user->comments()->count() }} </td>
                            <td><i>{{ date('M d, Y', strtotime($user->created_at)) }}</i></td>
                            <td>
                                <a class="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                                    aria-controls="offcanvasExample" @click="edit({{ $user->id }})"><i
                                        class="fa fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ url('admin/users/' . $user->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <!-- <input type= "hidden" name="_method" value ="DELETE"> -->
                                    <button
                                        onclick = 'return confirm("{{ Auth::user()->name }}, do you want to delete this User? Click OK to delete or CANCEL to return")'>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        @else
            Your users will be listed here soon when you have users.
        @endif
        <hr>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title tw-font-bold" id="offcanvasExampleLabel" x-text="userFullName"></h5>
                <button @click="reloadPage" type="button" class="btn-close" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                {{-- first name --}}
                <div class="tw-mb-3">
                    <div class="tw-flex tw-justify-between">
                        <label for="first_name" class="form-label">First Name</label>
                        <span class="tw-font-bold" x-show="!isEditing" x-text="currentUser?.first_name"></span>
                    </div>
                    <div x-show="isEditing" class="tw-max-w-80">
                        <input type="text" class="form-control" :class="0 ? 'is-invalid' : 'is-valid'"
                            id="validationServer01" :value="currentUser?.first_name" disabled>
                    </div>
                </div>
                {{-- last name --}}
                <div class="tw-mb-3">
                    <div class="tw-flex tw-justify-between">
                        <label for="last_name" class="form-label">Last Name</label>
                        <span class="tw-font-bold" x-show="!isEditing" x-text="currentUser?.last_name"></span>
                    </div>
                    <div x-show="isEditing" class="tw-max-w-80">
                        <input type="text" class="form-control" :class="0 ? 'is-invalid' : 'is-valid'"
                            id="validationServer01" :value="currentUser?.last_name" disabled>
                    </div>
                </div>
                {{-- email --}}
                <div class="tw-mb-3">
                    <div class="tw-flex tw-justify-between">
                        <label for="email" class="form-label">Email</label>
                        <span class="tw-font-bold" x-show="!isEditing" x-text="currentUser?.email"></span>
                    </div>
                    <div x-show="isEditing" class="tw-max-w-80">
                        <input type="text" class="form-control" :class="0 ? 'is-invalid' : 'is-valid'"
                            id="validationServer01" :value="currentUser?.email" disabled>
                    </div>
                </div>
                {{-- phone number --}}
                <div class="tw-mb-3">
                    <div class="tw-flex tw-justify-between">
                        <label for="tel" class="form-label">Phone No.</label>
                        <span class="tw-font-bold" x-show="!isEditing" x-text="currentUser?.tel"></span>
                    </div>
                    <div x-show="isEditing" class="tw-max-w-80">
                        <input type="text" class="form-control" :class="0 ? 'is-invalid' : 'is-valid'"
                            id="validationServer01" :value="currentUser?.tel" disabled>
                    </div>
                </div>
                {{-- role --}}
                <div class="tw-mb-3">
                    <div class="tw-flex tw-justify-between">
                        <label for="tel" class="form-label">User Role</label>
                        <span class="tw-font-bold" x-show="!isEditing" x-text="userRole"></span>
                    </div>
                    <div x-show="isEditing" class="tw-max-w-80">
                        <select class="form-select" x-model="userForm.role_id" name="role"
                            aria-label="Select user role">
                            <option value="" selected>No role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- submit button --}}
                <div x-show="isEditing" class="mb-3 text-center">
                    <button @click="updateUser()" class="btn btn-primary">
                        <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Assign Role
                    </button>
                </div>
                {{-- user info --}}
                <div x-show="!isEditing" class="alert alert-info" role="alert">
                    Click the close ( X ) button above to reload users data.
                </div>
            </div>
        </div>
        {{-- bs toast --}}
        @include('bs-toast')

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

                Alpine.data('users', () => ({
                    loading: false,
                    isEditing: false,
                    users: {{ Js::from($users) }},
                    currentUser: null,
                    userForm: {
                        user_id: null,
                        role_id: null,
                    },
                    toastMessage: 'Hail Christ',

                    async init() {
                        console.log(this.users.data.length);
                    },

                    // GETTERS
                    get userFullName() {
                        let name = this.currentUser?.first_name;
                        name += this.currentUser?.last_name ? ` ${this.currentUser?.last_name}` : '';
                        return name;
                    },
                    get userRole() {
                        return this.currentUser?.roles.length ? this.currentUser?.roles[0].name :
                            'No role';
                    },

                    // METHODS
                    async edit(userID) {
                        this.currentUser = this.users.data.find(user => user.id == userID);
                        if (this.currentUser.roles.length) {
                            console.log('user has role');
                            this.userForm.role_id = this.currentUser.roles[0].id;
                        } else {
                            // reset it to null
                            this.userForm.role_id = null;
                        }
                        this.userForm.user_id = this.currentUser.id;
                        this.isEditing = true;
                    },
                    reloadPage() {
                        location.reload();
                    },
                    selectImage() {
                        if (this.isEditing)
                            this.$refs.avatar.click()
                    },
                    async updateUser() {
                        this.loading = true;
                        this.userForm['_method'] = 'put';
                        try {
                            const {
                                data
                            } = await axios.post('/admin/users/' + this.userForm.id, this.userForm);
                            // this.user = data.data;
                            console.log(data);
                            this.toastMessage = data.message;
                        } catch (error) {
                            console.log('error updating user profile:', error);
                            this.toastMessage = "Error updating profile";
                        } finally {
                            this.loading = this.isEditing = false;
                            toastTrigger.click();
                        }
                    },
                }));
            });
        </script>
    </section>
</x-user-layout>
