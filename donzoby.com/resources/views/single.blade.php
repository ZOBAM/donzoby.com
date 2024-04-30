<x-app-layout :$posts :listed-subjects="$listed_subjects" :description="$description" :title="$title" :page-image="$page_image" customStyle="single">

    <section id="single">
        @isset($post)
            <div id="bread-comb" class="tw-pl-2">
                <i class="fas fa-location-arrow"></i>
                <a href="/">Home</a> <i class="fas fa-angle-double-right"></i>
                <a href="/{{ $post->subject->course->slug }}">{{ ucwords($post->subject->course->name) }}</a> <i
                    class="fa fa-angle-double-right"></i>
                <a href="/{{ $post->subject->course->slug }}/{{ $post->subject->slug }}">{{ $post->subject->name }}</a>
                <i class="fa fa-angle-double-right"></i>
                {{ $post->topic }}
            </div>
            <h1 id="topic" class="pb-2 text-center ">{{ $post->topic }}</h1>
            <div id="post-details" class="mb-4 tw-pl-2">
                <span><span class="tw-font-semibold">Last Update:</span>
                    {{ date('M d, Y', strtotime($post->updated_at)) }}</span>
                <span class="tw-float-right tw-cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Views">
                    <i class="fa fa-eye"></i> {{ $post->hits }} times.
                </span>
            </div>
            <div id="post-content" class="tw-pl-2">
                {!! $post->content !!}
            </div>
            <!-- -------------------------- Facebook Share button ---------------------- -->
            <!-- -------------------------- Facebook Share button ---------------------- -->
            <!-- Load Facebook SDK for JavaScript -->
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <!-- Your share button code -->
            <div class="fb-share-button tw-ml-2" data-href="{{ url()->current() }}" data-layout="button_count"
                data-size="large" data-mobile-iframe="true"><a target="_blank"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&amp;src=sdkpreparse"
                    class="fb-xfbml-parse-ignore">Share</a></div>
            <!-- -------------------------- display  comment ---------------------- -->
            <!-- -------------------------- display  comment ---------------------- -->
            <div x-data="comments" class="comments">

                {{-- bootstrap toast --}}
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

                {{-- for comment --}}
                <div class="card mt-5">
                    <div class="card-header"><i class="fa fa-comments"></i> {{ $post->topic }} <span
                            class="tw-float-right" x-text="`${comments.length} Comments`"> </span></div>
                    <template x-if="comments.length">
                        <div class="card-body">
                            <template x-for="(comment, index) in comments">
                                <div class="row tw-mt-4" style="border-bottom: 4px solid #cbd1cba4">
                                    <div class="col-sm-12 tw-flex tw-justify-between tw-items-center"
                                        style="background-color: #EFF1EF;border-top: 4px solid #cbd1cba4">
                                        <div class="tw-flex tw-items-center">
                                            <div class="tw-max-h-10 tw-overflow-hidden tw-rounded-s-full"><img
                                                    :src="'/' + comment.user.avatar" style="max-width: 40px"></div>
                                            <div class="tw-pl-2 tw-text-sm">
                                                <span class="tw-font-bold" x-text="comment.user.first_name"></span> On
                                                <span class="" x-text="comment.created_at.split('T')[0]"></span>
                                            </div>
                                        </div>
                                        {{-- ellipsis for showing comment options --}}
                                        <div class="tw-relative">
                                            <button type="button" @click="showCommentOptions(comment.id)"
                                                :disabled="!isLoggedIn || comment.user.id != user.id"
                                                :class="!isLoggedIn || comment.user.id != user.id ? 'tw-text-gray-400' : ''">
                                                <i x-show="loading.delete && focusedCommentID == comment.id"
                                                    class="fa fa-spinner tw-animate-spin" aria-hidden="true"></i>
                                                <i x-show="!loading.delete" class="fa fa-ellipsis-v tw-px-2"
                                                    aria-hidden="true"></i>
                                            </button>
                                            <div x-show="show.commentOptions && focusedCommentID == comment.id"
                                                @click.outside="show.commentOptions = false"
                                                class="tw-absolute tw-bg-white tw-shadow-lg tw-p-1 tw-rounded tw-right-0 tw-top-6 tw-text-base">
                                                <button
                                                    class="tw-text-blue-800 hover:tw-text-blue-600 hover:tw-bg-blue-200 tw-block tw-bg-gray-100 tw-w-full"
                                                    @click="edit(comment)">Edit</button>
                                                <button
                                                    class="tw-text-red-800 hover:tw-text-red-600 hover:tw-bg-white tw-px-2 tw-block tw-bg-red-100"
                                                    @click="deleteComment(comment.id, index)">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                    <template x-if="comment.id != commentForm.id">
                                        <div class="col-sm-12 tw-text-sm" style="margin: 5px 0px" x-text="comment.content">
                                        </div>
                                    </template>
                                    {{-- display form for editing comment --}}
                                    <template x-if="isEditing && comment.id == commentForm.id">
                                        <div class="col-sm-12 tw-my-2">
                                            <button class="btn tw-float-right tw-text-red-300" @click="closeEditForm"><i
                                                    class="fa fa-times" aria-hidden="true"></i>
                                                Close</button>
                                            <textarea rows="4" x-model="commentForm.content" placeholder="Write comment here." class="form-control"
                                                :class="commentForm.content?.length && hasError.content.hasError ?
                                                    'is-invalid' :
                                                    'is-valid'"></textarea>
                                            <span class="invalid-feedback" role="alert">
                                                Comment should be 3-1600 characters
                                            </span>
                                        </div>
                                    </template>
                                    <div class="col-sm-12" style="border-top: 4px solid #EFF1EF">
                                        <template x-if="isLoggedIn">
                                            <div class="tw-text-right">
                                                {{-- <button class="btn btn-outline-primary btn-sm" @click="edit(comment)"
                                                    x-show="comment.id != commentForm.id">Edit</button> --}}
                                                <button class="btn btn-outline-primary btn-sm"
                                                    x-show="isEditing && comment.id == commentForm.id"
                                                    @click="submitComment" :disabled="loading.update">
                                                    <i x-show="loading.update" class="fa fa-spinner tw-animate-spin"
                                                        aria-hidden="true"></i> Save
                                                    Change</button>
                                                {{-- <button class="tw-ml-2 btn btn-outline-danger btn-sm"
                                                    x-show="comment.id != commentForm.id"
                                                    @click="deleteComment(comment.id, index)">Delete</button> --}}
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
                <!-- -------------------------- display form for logged in user to write new comment ---------------------- -->
                <!-- -------------------------- display form for logged in user to write new comment ---------------------- -->
                <template x-if="!isLoggedIn">
                    <p class="">
                        <i class="fas fa-pencil-square"></i><a href="{{ url('register') }}"
                            class="align-middle">Register</a>
                        or
                        <a class="" href="{{ url('login') }}">Login</a> to write comments.
                    </p>
                </template>
                <template x-if="isLoggedIn">
                    <div class="card tw-mt-4">
                        <div class="card-header"><i class="fa fa-comment"></i> <strong
                                x-text="user.first_name"></strong>,
                            <span class="float-right">add a comment</span>
                        </div>
                        <div class="card-body" x-show="!isEditing">
                            <form @submit.prevent="submitComment" id="comment">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea rows="5" x-model="commentForm.content" placeholder="Write comment here." class="form-control"
                                            :class="!commentForm.content?.length ? '' : commentForm.content?.length && hasError
                                                .content.hasError ? 'is-invalid' :
                                                'is-valid'"></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            Comment should be 3-1600 characters
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0 tw-flex tw-justify-center">
                                    <button type="submit" class="btn btn-primary tw-mt-4 tw-max-w-52"
                                        :disabled="loading.create || formHasError">
                                        <i x-show="loading.create" class="fa fa-spinner tw-animate-spin"
                                            aria-hidden="true"></i> Submit Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>
            </div>
        @endisset
    </section>
    <script>
        // alpine
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
            // bootstrap tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                tooltipTriggerEl))

            Alpine.data('comments', () => ({
                loading: {
                    create: false,
                    update: false,
                    delete: false,
                },
                comments: {{ Js::from($comments) }},
                user: {{ Js::from(Auth::user()) }},
                comment: null,
                show: {
                    commentOptions: false,
                },
                focusedCommentID: null,
                commentForm: {
                    id: null,
                    content: '',
                    post_id: {{ $post->id }},
                    parent_id: null,
                    isChild: false,
                },
                validationRules: {
                    content: {
                        minLength: 3,
                        maxLength: 1600,
                    },
                },
                toastMessage: 'Hail Christ',
                isEditing: false,
                editedCommentIndex: null,

                async init() {
                    console.log(this.comments);
                    if (this.post) {
                        console.log('the returned post', this.post);
                        this.postForm = {
                            ...this.post
                        };
                        this.postForm.status = this.postForm.status == 'published' ? true : false;
                        this.postForm.course_id = this.post.subject.course_id;
                        this.isEditing = true;
                        this.postForm.isChild = this.post.parent_id != null ? true : false;
                        /* TODO:
                        Later make getPostParents accept the parent ID for editing post to fetch only the parent
                         */
                        if (!this.postForm.isChild) {
                            delete this.validationRules.parent_id;
                        } else {
                            setTimeout(async () => {
                                await this.getPostParents();
                            }, 1000);
                        }
                        // revalidate form
                        setTimeout(() => {
                            this.validateForm();
                        }, 2000);
                    }
                },

                // Getters
                get subjects() {
                    if (!this.postForm.course_id) return [];
                    return this.courses.find(course => course.id == this.postForm.course_id)
                        .subjects;
                },

                get isLoggedIn() {
                    return this.user;
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

                // methods
                formatErrorMsg(rules, rule, msg) {
                    let fieldName = rules[rule].hasOwnProperty('name') ? rules[rule].name : rule
                        .replaceAll('_', ' ');
                    // let fieldName = rule.replaceAll('_', ' ');
                    return msg.replaceAll('_', fieldName);
                },
                validateForm() {
                    const rules = this.validationRules;

                    for (let rule in rules) {
                        /* if (!this.postForm[rule]) {
                            continue;
                        } */
                        let field = rules[rule];

                        for (let ruleItem in field) {
                            if (ruleItem === 'maxLength' || ruleItem === 'minLength') {
                                let currentValue = this.commentForm[rule]?.length;
                                const isTooShort = currentValue < field['minLength'];
                                const isTooLong = currentValue > field['maxLength'];
                                rules[rule]['hasError'] = false;
                                if (isTooShort || isTooLong) {
                                    rules[rule]['hasError'] = true;
                                    // only generate programmatic message if custom message is not set
                                    rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                        `_ too short. Min length ${field['minLength']} characters::${currentValue}`
                                    );
                                    if (isTooLong) {
                                        rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                            `_ too long. Max length ${field['maxLength']} characters`
                                        );
                                    }

                                    // alert(rule + ' too long!');
                                }
                            } else if (ruleItem === 'min' || ruleItem === 'max') {
                                const currentValue = this.commentForm[rule];
                                rules[rule]['hasError'] = false;
                                // check if the value is a number
                                if (isNaN(parseInt(currentValue))) {
                                    rules[rule]['hasError'] = true;
                                    rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                        `_ should be a number `);
                                } else {
                                    const isSmaller = Number(currentValue) < Number(field['min']);
                                    const isBigger = Number(currentValue) > Number(field['max']);
                                    if (isSmaller || isBigger) {
                                        rules[rule]['hasError'] = true;
                                        let minAmount = field['min'];
                                        const maxAmount = field['max'];
                                        rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                            `_ too small. Min amount ${minAmount} `);
                                        if (isBigger) {
                                            rules[rule]['message'] = this.formatErrorMsg(rules,
                                                rule, `_ too big. Max amount ${maxAmount}`);
                                            // _ too big. Max amount ${maxAmount} 
                                        }
                                        // alert(rule + ' too small!' + currentValue + ' : min is ' + Number(field['min']));
                                    }
                                }

                            }
                        }
                    }
                    // console.log(rules);
                    return rules;
                },

                async submitComment() {
                    const payload = this.commentForm;
                    let link = '/comments';
                    if (this.isEditing) {
                        payload['_method'] = 'put';
                        link += `/${this.comment.id}`;
                        console.log('About to post edit: ', link);
                        console.log(payload);
                        this.loading.update = true;
                    } else {
                        this.loading.create = true;
                    }
                    try {
                        const {
                            data
                        } = await axios.post(link, payload);
                        console.log(data);
                        this.resetObject(this.commentForm);
                        if (this.isEditing) {
                            this.isEditing = false;
                            this.comments[this.editedCommentIndex] = data.data;
                        } else {
                            this.comments.push(data.data);
                        }
                        this.toastMessage = data.message;
                    } catch (error) {
                        console.log('Error submitting comment: ', error);
                        this.toastMessage = "Error submitting";
                    } finally {
                        this.loading.update = false;
                        this.loading.create = false;
                        toastTrigger.click();
                    }
                },

                async deleteComment(commentID, index) {
                    this.loading.delete = true;
                    try {
                        const response = await axios.delete(`/comments/${commentID}`);
                        if (response.data.status == 'success') {
                            console.log('comment deleted');
                            this.comments.splice(index, 1);
                        }
                        this.toastMessage = response.data.message;
                    } catch (error) {
                        console.log('error deleting comment: ', error);
                        this.toastMessage = 'Deleting comment failed';
                    } finally {
                        this.loading.delete = false;
                        toastTrigger.click();
                    }
                },

                resetObject(obj) {
                    for (const field in obj) {
                        if (field == 'post_id') continue;
                        obj[field] = null;
                    }
                },
                async edit(comment) {
                    this.editedCommentIndex = this.comments.indexOf(comment);
                    console.log('about to edit comment: ', comment);
                    this.commentForm = {
                        ...comment
                    };
                    console.log(this.commentForm);
                    this.isEditing = true;
                    this.show.commentOptions = false;
                },
                closeEditForm() {
                    this.resetObject(this.commentForm);
                    this.isEditing = false;
                },
                showCommentOptions(commentID) {
                    this.focusedCommentID = commentID;
                    this.show.commentOptions = !this.show.commentOptions;
                    console.log(this.focusedCommentID, this.show.commentOptions);
                }
            }));
        });
    </script>
</x-app-layout>
