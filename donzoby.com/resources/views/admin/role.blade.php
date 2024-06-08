<x-user-layout>

    <h1 class="text-center tw-my-4">Donzoby Roles & Permissions</h1>
    <section x-data="role" class="tw-bg-gray-200 tw-p-4">
        {{-- bs toast --}}
        <button type="button" class="btn btn-primary tw-hidden" id="liveToastBtn">Show live toast</button>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('images/donzoby-logo-wtbg.png') }}" width="35" class="rounded me-2"
                        alt="...">
                    <strong class="me-auto">Donzoby</strong>
                    <small>Action Success</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" x-text="toastMessage">
                </div>
            </div>
        </div>

        {{-- tabs --}}
        <div class="tw-bg-red-500 text-center tw-py-2" style="background-color: gray;">
            <buttun @click="switchTab('role')" class="btn btn-outline-light">Roles</buttun>
            <buttun @click="switchTab('permission')" class="btn btn-outline-light">Permissions</buttun>
        </div>

        <div class=" tw-flex">
            <div class="tw-px-4 tw-min-w-52">
                <h2 class="tw-font-bold tw-mt-2 text-capitalize" x-text="currentType + 's' "></h2>
                <ol class="tw-list-decimal">
                    <template x-for="(item, index) in currentItems">
                        <li x-text="item.name" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-p-2 tw-text-sm"
                            :class="index == currentRoleIndex ? 'tw-bg-gray-100' : ''"
                            @click="switchShow(isRole? 'roleDetails' : 'permissionDetails', index)"></li>
                    </template>
                </ol>
                <button @click="switchShow('postForm', isRole? 'newRole': 'newPermission')"
                    class="btn btn-primary tw-mt-4" :disabled="!permissions.length">
                    <i class="fa fa-plus" aria-hidden="true"></i> <span class="text-capitalize"
                        x-text="'Add ' + currentType"></span>
                </button>
                {{-- <button @click="switchShow('postForm', 'newPermission')" class="btn btn-primary tw-mt-4">
                    <i class="fa fa-plus" aria-hidden="true"></i> 
                </button> --}}
            </div>
            <div class="tw-bg-white tw-p-4 tw-flex-grow">
                {{-- for new course OR permission --}}
                <div x-show="show.postForm" class="tw-">
                    <h2 class="text-center tw-mb-4" x-html="formTitle">
                    </h2>
                    <p class="tw-text-xs tw-text-red-500 text-center" x-show="serverErrorMsg" x-text="serverErrorMsg">
                    </p>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">
                            <span class="text-capitalize" x-text="currentType"></span> Name:
                        </label>
                        <input type="email" class="form-control" x-model="postForm.name"
                            :placeholder="`unique ${currentType} name`">
                    </div>
                    <div x-show="isRole" class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"><span class="text-capitalize"
                                x-text="currentType"></span>
                            Description:</label>
                        <textarea class="form-control" x-model="postForm.description" rows="3"></textarea>
                    </div>
                    {{-- list available permissions --}}
                    <div x-show="isRole" class="tw-flex">
                        <template x-for="(permission, index) in permissions">
                            <div class="form-check" style="margin-right: .5rem; box-shadow: 1px 1px 1px 2px gray;">
                                <input @click="selectPermission(permission)" class="form-check-input" type="checkbox"
                                    :value="index" :id="'flexCheckDefault' + index"
                                    :checked="hasPermission(permission.id)">
                                <label class="form-check-label tw-p-1" :for="'flexCheckDefault' + index"
                                    x-text="permission.name">
                                </label>
                            </div>
                        </template>
                    </div>
                    {{-- <select x-show="currentType == 'permission'" class="form-select mb-3" aria-label="Select role"
                        :disabled='true' x-model="postForm.role_id">
                        <option selected>Select a role</option>
                        <template x-for="role in roles">
                            <option :value="role.id" x-text="role.name"></option>
                        </template>
                    </select> --}}
                    <div class="text-center tw-mt-4">
                        <button class="btn btn-primary" @click="submitForm()" :disabled="loading">
                            <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span x-text="submitBtnText"></span>
                        </button>
                    </div>
                </div>
                {{-- for details --}}
                <template x-if="targetObject && (show.roleDetails || show.permissionDetails)">
                    <div class="tw-flex tw-flex-col tw-justify-between" style="min-height: 100%">
                        <div class="">
                            <h2 class="text-center tw-font-bold" x-text="targetObject.name"></h2>
                            <p class="tw-pt-4" x-text="targetObject.description">
                            </p>
                            <template x-if="show.roleDetails">
                                <div class="">
                                    <h3 class="tw-mt-4 tw-font-bold">Permissions</h3>
                                    {{-- list permissions --}}
                                    <ol class="tw-list-decimal tw-m-4">
                                        <template x-for="(permission, index) in targetObject.permissions">
                                            <li x-text="permission.name"
                                                @click="switchShow('permissionDetails', index)"
                                                class="tw-cursor-pointer hover:tw-text-black hover:tw-underline tw-underline-offset-4">
                                            </li>
                                        </template>
                                    </ol>
                                    <template x-if="roles[currentRoleIndex].permissions.length == 0">
                                        <p class="tw-pb-4">
                                            The role '<span x-text="targetObject.name" class="tw-font-bold"></span>',
                                            does
                                            not
                                            have
                                            any
                                            permission yet.
                                        </p>
                                    </template>
                                </div>
                            </template>
                        </div>
                        <div class="text-center">
                            {{-- only show add permission btn if on role details --}}
                            <template x-if="!show.permissionDetails">
                                <button class="btn btn-primary" @click="switchShow('postForm', 'newPermission')">
                                    <span x-show="loading" class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                    Add Permission
                                </button>
                            </template>
                            <button class="btn btn-outline-primary" @click="edit" :disabled="loading">
                                <span x-show="loading" class="spinner-border spinner-border-sm"
                                    aria-hidden="true"></span>
                                Edit <span x-text="show.roleDetails? 'Role': 'Permission'"></span>
                            </button>
                            <button class="btn btn-danger" @click="remove()" :disabled="loading">
                                <span x-show="loading" class="spinner-border spinner-border-sm"
                                    aria-hidden="true"></span>
                                Delete <span x-text="show.roleDetails? 'Role': 'Permission'"></span>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
    <script>
        const rolesJson = {{ Js::from($roles) }};
        const permissionsJson = {{ Js::from($permissions) }};
        window.onload = function() {
            /* setTimeout(() => {
                toastTrigger.click();
            }, 2000); */
        }

        // console.log(rolesJson);
        document.addEventListener('alpine:init', () => {
            const toastTrigger = document.getElementById('liveToastBtn');
            const toastLiveExample = document.getElementById('liveToast');

            if (toastTrigger) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastTrigger.addEventListener('click', () => {
                    toastBootstrap.show();
                })
            }
            Alpine.data('role', () => ({
                loading: false,
                roles: rolesJson,
                permissions: permissionsJson,
                toastTrigger: toastTrigger,
                isEditingTarget: false,
                show: {
                    postForm: false,
                    roleDetails: false,
                    permissionDetails: false,
                },
                currentRoleIndex: 0,
                currentPermissionIndex: 0,
                currentItems: [],
                targetObject: null,
                postFormCopy: null,
                postForm: {
                    id: null,
                    name: '',
                    description: '',
                },
                toastMessage: 'Hail Christ',
                currentType: 'role',
                serverErrorMsg: null,
                permissions_ids: [],

                async init() {
                    this.switchShow('roleDetails', 0);
                },

                // GETTERS
                get formTitle() {
                    let title = this.isEditingTarget ? 'Editing ' : 'New ';
                    title += this.currentType;
                    /* title += this.currentType == 'permission' ? ` in <strong>${this.permissions[this.currentRoleIndex]
                .name}</strong>` :
                                                                                                                                                                                                                                                                                                                                                                                                                                            ''; */
                    return title;
                },
                get submitBtnText() {
                    let text = this.isEditingTarget ? 'Update ' : 'Save ';
                    text += this.currentType;
                    return text;
                },
                get isRole() {
                    return this.currentType == 'role';
                },

                // METHODS
                switchTab(type) {
                    if (this.currentType == type) return;
                    this.currentType = type;
                    this.targetObject = null;
                    this.switchShow(type + 'Details', 0);
                },
                selectPermission(permission) {
                    if (this.permissions_ids.includes(permission.id)) {
                        // console.log('permission already added');
                        this.permissions_ids.splice(this.permissions_ids.indexOf(permission.id), 1);
                    } else {
                        // console.log(permission);
                        this.permissions_ids.push(permission.id)
                    }
                    console.log(this.permissions_ids);
                },
                switchShow(componentName, index = null) {
                    this.isEditingTarget = false;
                    // loop through show and hide all others except one
                    for (const elem in this.show) {
                        if (elem != componentName) {
                            this.show[elem] = false;
                        } else {
                            this.show[elem] = true;
                        }
                    }
                    console.log(this.show);
                    if (index !== null) {
                        if (index == 'newRole' || index == 'newPermission') {
                            // const type = componentName.split('F')[0];
                            if (this[`${componentName}Copy`]) {
                                this[componentName] = this[`${componentName}Copy`];
                            }
                            this.resetObject(this[componentName]);
                            this.currentType = index == 'newRole' ? 'role' : 'permission'
                        } else if (componentName == 'roleDetails') {
                            this.currentType = 'role';
                            this.currentRoleIndex = index;
                            this.currentItems = this.roles;
                            this.targetObject = this.roles[index];
                        } else { // it is permission details
                            this.currentType = 'permission';
                            this.currentPermissionIndex = index;
                            this.currentItems = this.permissions;
                            this.targetObject = this.permissions[index];
                        }
                    }
                    console.log('the current type is: ', this.currentType);
                },
                hasPermission(permissionID) {
                    if (!this.isRole) return;
                    return this.targetObject.permissions.find(permission => permission.id ==
                        permissionID);
                },
                resetObject(obj) {
                    for (const field in obj) {
                        obj[field] = null;
                    }
                },
                async submitForm() {
                    this.loading = true;
                    const isRole = this.currentType == 'role';
                    const payload = this.postForm;

                    const typeBaseName = `${this.currentType}s`;
                    let link = `/${typeBaseName}`;
                    const isEditing = payload.id;
                    if (isEditing) {
                        payload['_method'] = 'put';
                        link += `/${payload.id}`;
                    }
                    if (isRole) {
                        payload.permissions_ids = this.permissions_ids;
                    }
                    try {
                        console.log('Payload***', payload);
                        const response = await axios.post(link, payload);
                        if (response.data) {
                            console.log('Data from back end: ', response.data);
                            if (isRole) {
                                if (isEditing) {
                                    this.roles[this.currentRoleIndex] = response.data.data;
                                } else {
                                    this.roles.push(response.data.data);
                                }
                                // show the role detial
                                this.switchShow('roleDetails', this.currentRoleIndex);
                            } else {
                                if (isEditing) {
                                    const newPermission = response.data.data;
                                    let rolePermissionIndex = null;
                                    // loop through roles and replace the edited permission
                                    for (const role in this.roles) {
                                        const roleHasPermission = this.roles[this.currentRoleIndex]
                                            .permissions.find((permission, index) => {
                                                if (permission.id == newPermission.id) {
                                                    rolePermissionIndex = index;
                                                    this.roles[this.currentRoleIndex]
                                                        .permissions[index] =
                                                        newPermission;
                                                    // break;
                                                }
                                            });

                                        // 
                                    }

                                    this.permissions[this.currentPermissionIndex] = newPermission;
                                    // show the permission detail
                                    this.switchShow('permissionDetails', this
                                        .currentPermissionIndex);
                                } else {
                                    this.permissions.push(response
                                        .data.data);
                                    // show the role detial
                                    this.switchShow('permissionDetails', this
                                        .currentPermissionIndex);
                                }
                            }
                        }
                        this.toastMessage = response.data.message;
                        toastTrigger.click();
                    } catch (error) {
                        console.log('sorry an error occurred', error);
                        this.serverErrorMsg = error.response.data.message;
                        setTimeout(() => {
                            this.serverErrorMsg = null;
                        }, 1500);
                    } finally {
                        this.loading = false;
                        this.isEditingTarget = false;
                        // const payload = type == 'role' ? this.resetObject(this.roleForm) : this
                        //     .resetObject(this.permissionForm);
                    }
                },

                edit() {
                    if (this.show.roleDetails) {
                        // copy role form if not yet copied
                        if (!this.postFormCopy) {
                            this.postFormCopy = structuredClone(this.postForm.target);
                        }
                        this.postForm = {
                            ...this.targetObject
                        }
                        // fill up the permissions_ids array
                        this.permissions_ids = [];
                        for (const permission of this.targetObject.permissions) {
                            this.permissions_ids.push(permission.id);
                        }
                        console.log(this.permissions_ids);
                        // set postFormCopy to null since both role and permission are using it
                        this.postFormCopy = null;
                        this.switchShow('postForm');
                    } else {
                        // copy permission form if not yet copied
                        if (!this.postFormCopy) {
                            this.postFormCopy = structuredClone(this.postForm.target);
                        }
                        this.postForm = {
                            ...this.targetObject
                        }
                        // set postFormCopy to null since both role and permission are using it
                        this.postFormCopy = null;
                        this.switchShow('postForm');
                    }
                    this.isEditingTarget = true;

                },
                // remove item
                async remove() {
                    const sure = confirm('Are you sure you want to delete this resources');
                    const isRole = this.show.roleDetails;
                    let link = isRole ? '/roles' : '/permissions';
                    link += '/' + this.targetObject.id;
                    if (sure) {
                        try {
                            const response = await axios.delete(link);
                            console.log(response.data);

                            this.toastMessage = response.data.message;
                            if (isRole) {
                                const updatesRoleList = this.roles.filter((role) => role
                                    .id != this.targetObject.id);
                                this.roles = updatesRoleList;
                                if (updatesRoleList.length) {
                                    // if deleted role is the last on the list, show the one just above it
                                    if (this.currentRoleIndex >= updatesRoleList.length) {
                                        this.currentRoleIndex--;
                                        console.log('Role index', this.currentRoleIndex);
                                    }
                                    // show the role detial
                                    this.switchShow('roleDetails', this.currentRoleIndex);
                                } else {
                                    this.switchShow('roleForm', 'new');
                                }
                            } else {
                                const updatesPermissionList = this.roles[this.currentRoleIndex]
                                    .permissions.filter(sub => sub.slug != this.targetObject.slug);
                                this.roles[this.currentRoleIndex].permissions =
                                    updatesPermissionList;
                                // show the role detial
                                this.switchShow('roleDetails', this.currentRoleIndex);
                            }
                            toastTrigger.click();
                        } catch (error) {
                            console.log('A delete error occured: ', error);
                        }
                    }
                }
            }));
        });
    </script>
</x-user-layout>
