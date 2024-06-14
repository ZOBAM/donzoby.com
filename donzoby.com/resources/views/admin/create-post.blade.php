<x-user-layout>
    @php
        $isEditing = isset($post);
    @endphp
    <h1 class="text-center tw-my-4">
        @if ($isEditing)
            Editing: <span class="tw-font-bold">{{ $post->topic }}</span>
        @else
            Write a New Post
        @endif
    </h1>
    <section x-data="course" class="tw-max-w-3xl tw-m-auto">
        <form @submit.prevent="submitPost" action="{{ url('posts') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Course</label>
                        <select class="form-select " :class="hasError.course_id.hasError ? 'is-invalid' : 'is-valid'"
                            x-model="postForm.course_id" name="course" aria-label="Default select example">
                            <option selected>Choose A Course</option>
                            <template x-for="course in courses">
                                <option :value="course.id" x-text="course.name"
                                    :selected="post && course.id == post.subject.course_id"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Subject</label>
                        <select class="form-select" :class="hasError.subject_id.hasError ? 'is-invalid' : 'is-valid'"
                            x-model="postForm.subject_id" name="subject" aria-label="Default select example">
                            <option selected>Select Subject</option>
                            <template x-for="subject in subjects">
                                <option :value="subject.id" x-text="subject.name"
                                    :selected="post && subject.id == post.subject_id"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Topic</label>
                        <input type="text" x-model="postForm.topic" name="topic"
                            :class="hasError.topic.hasError ? 'is-invalid' : 'is-valid'" class="form-control"
                            id="exampleFormControlInput1" placeholder="give it some title" required>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Type</label>
                        <select class="form-select" :class="hasError.type.hasError ? 'is-invalid' : 'is-valid'"
                            x-model="postForm.type" name="type" aria-label="Default select example">
                            <option value="course-series" selected>Course</option>
                            <option value="special-series">Special Series</option>
                            <option value="how-tos">How Tos</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row tw-mt-3">
                <div @click="getPostParents()" class="col col-md-3 tw-flex tw-items-end">
                    <div class="mb-3 form-check form-switch tw-flex tw-justify-center tw-items-center tw-pb-3">
                        <input class="form-check-input" x-model="postForm.isChild" name="is_child" type="checkbox"
                            role="switch" id="flexSwitchCheckDefault" :disabled="!postForm.subject_id">
                        <label class="form-check-label tw-ml-1" for="flexSwitchCheckDefault">Is Child</label>
                    </div>
                </div>
                <div x-show="postForm.isChild" x-transition.duration.750ms class="col col-md-6">
                    <div class="mb-3">
                        {{-- <label for="exampleFormControlInput1" class="form-label">Select Parent Post</label> --}}
                        <select class="form-select"
                            :class="postForm.isChild && hasError.parent_id?.hasError ? 'is-invalid' : 'is-valid'"
                            x-model="postForm.parent_id" name="parent" aria-label="Default select example"
                            :disabled="loading">
                            <option selected>Select Parent Post</option>
                            <template x-for="parent in postParents">
                                <option :value="parent.id" x-text="parent.topic"
                                    :selected="parent.id == postForm.parent_id"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="col col-md-3 tw-flex tw-items-end">
                    <div class="mb-3 form-check form-switch tw-flex tw-justify-center tw-items-center tw-pb-3">
                        <input class="form-check-input" x-model="postForm.status" name="published" type="checkbox"
                            role="switch" id="flexSwitchCheckDefault2">
                        <label class="form-check-label tw-ml-1" for="flexSwitchCheckDefault2">Publish Now</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Body</label>
                <textarea class="form-control is-invalid" x-model="postForm.content" name="content" id="content" rows="15"></textarea>
                <div x-show="hasError.content.hasError" class="invalid-feedback">
                    Please, each post should have between 40 to 500 words.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tags</label>
                <input type="text" x-model="postForm.tags" name="tags" class="form-control"
                    id="exampleFormControlInput1" :class="hasError.tags.hasError ? 'is-invalid' : 'is-valid'"
                    placeholder="post tags">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Description/Excerpt</label>
                <textarea class="form-control" :class="hasError.description.hasError ? 'is-invalid' : 'is-valid'"
                    x-model="postForm.description" name="description" id="exampleFormControlTextarea1" rows="2"></textarea>
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-primary" :disabled="loading || formHasError">
                    <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    @if ($isEditing)
                        Update Post
                    @else
                        Submit Post
                    @endif
                </button>
            </div>
        </form>
        {{-- bs toast --}}
        @include('bs-toast')
    </section>
    {{-- Add page specific JS --}}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=aebyz7zeke446ygrs6h75wf7p21s7cprkwa7fl5cmrfwj6ly">
    </script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: [
                "advlist autolink code link image lists charmap print preview hr anchor pagebreak spellchecker codesample wordcount media"
            ],
            toolbar: 'undo redo | image media code link codesample | hr numlist bullist | aligncenter',

            // without images_upload_url set, Upload tab won't show up
            images_upload_url: '/image-upload',
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/image-upload');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
        });
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

            Alpine.data('course', () => ({
                loading: false,
                courses: {{ Js::from($courses) }},
                post: {{ isset($post) ? Js::from($post) : 'null' }},
                postParents: [],
                loadedParents: false,
                show: {
                    selectParent: false,
                    subjectForm: false,
                    courseDetails: false,
                    subjectDetails: false,
                },
                postForm: {
                    post_id: null,
                    course_id: null,
                    subject_id: null,
                    type: 'course-series',
                    topic: '',
                    content: '',
                    status: '',
                    tags: '',
                    description: '',
                    parent_id: null,
                    isChild: false,
                },
                validationRules: {
                    type: {
                        minLength: 5,
                        maxLength: 20,
                    },
                    /* parent_id: {
                        min: 1,
                        max: 1000000,
                    }, */
                    course_id: {
                        min: 1,
                        max: 1000000,
                    },
                    subject_id: {
                        min: 1,
                        max: 1000000,
                    },
                    topic: {
                        minLength: 7,
                        maxLength: 200,
                    },
                    content: {
                        minLength: 40,
                        maxLength: 500,
                    },
                    tags: {
                        minLength: 4,
                        maxLength: 200,
                    },
                    description: {
                        minLength: 30,
                        maxLength: 1500,
                    },
                },
                toastMessage: 'Hail Christ',
                isEditing: false,

                async init() {
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
                logWordCount() {
                    const wordCount = tinymce.activeEditor?.plugins.wordcount.getCount();
                    /* const wordcount = tinymce.activeEditor.plugins.wordcount;
                    console.log(wordcount.body.getWordCount()); */
                    // console.log(wordCount);
                    return wordCount == undefined ? 0 : wordCount;
                },
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
                                let currentValue = this.postForm[rule]?.length;
                                if (rule == 'content') {
                                    currentValue = this.logWordCount();
                                }
                                const isTooShort = currentValue < field['minLength'];
                                const isTooLong = currentValue > field['maxLength'];
                                rules[rule]['hasError'] = false;
                                if (isTooShort || isTooLong) {
                                    rules[rule]['hasError'] = true;
                                    // only generate programmatic message if custom message is not set
                                    rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                        `_ too short. Min length ${field['minLength']} characters`
                                    );
                                    if (isTooLong) {
                                        rules[rule]['message'] = this.formatErrorMsg(rules, rule,
                                            `_ too long. Max length ${field['maxLength']} characters`
                                        );
                                    }

                                    // alert(rule + ' too long!');
                                }
                            } else if (ruleItem === 'min' || ruleItem === 'max') {
                                const currentValue = this.postForm[rule];
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
                async getPostParents() {
                    // if parents has been loaded and empty, don't enable button
                    if (this.loadedParents && !this.postParents.length) {
                        // add parent validation rule
                        this.validationRules.parent_id = {
                            min: 1,
                            max: 1000000,
                        };
                        this.loadedParents = false;
                        return;
                    }
                    // only load parents when isChild
                    if (this.postForm.isChild && !this.isEditing) {
                        // remove parent validation
                        delete this.validationRules.parent_id;
                        // make is parent null
                        this.postForm.parent_id = null;
                        return;
                    }

                    console.log('isChild>>>>', this.postForm.isChild);
                    this.loading = true;
                    try {
                        const {
                            data
                        } = await axios.get(
                            `/posts?subject_id=${this.postForm.subject_id}&type=${this.postForm.type}`
                        );
                        this.postParents = data.parents;
                        // disable is child if there is no possible parent
                        console.log('this is parents: ', this.postParents);
                        if (!this.postParents.length) {
                            this.postForm.isChild = false;
                        } else {
                            // add parent validation rule
                            this.validationRules.parent_id = {
                                min: 1,
                                max: 1000000,
                            };
                        }
                        this.loadedParents = true;
                        console.log(data);
                    } catch (error) {
                        console.log('Error loading post parents: ', error);
                    } finally {
                        this.loading = false;
                    }
                },
                async submitPost() {
                    this.loading = true;
                    // set post content
                    this.postForm.content = tinymce.activeEditor.getContent();
                    this.postForm.status = this.postForm.status ? 'published' : 'unpublished';
                    const payload = this.postForm;
                    let link = '/posts';
                    if (this.isEditing) {
                        payload['_method'] = 'put';
                        link += `/${this.post.id}`;
                        console.log('About to post edit: ', link);
                        console.log(payload);
                    }
                    try {
                        const {
                            data
                        } = await axios.post(link, payload);
                        console.log(data);
                        this.toastMessage = data.message;
                    } catch (error) {
                        console.log('Error submitting post: ', error);
                        this.toastMessage = "post update failed";
                    } finally {
                        this.loading = false;
                        toastTrigger.click();
                    }
                }
            }));
        });
    </script>
</x-user-layout>
