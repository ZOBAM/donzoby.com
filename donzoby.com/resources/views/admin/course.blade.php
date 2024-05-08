<x-user-layout>

    <h1 class="text-center tw-my-4">Donzoby Courses</h1>
    <section x-data="course" class="tw-bg-gray-200 tw-p-4 tw-flex">
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

        <div class="tw-px-4 tw-min-w-52">
            <h2 class="tw-font-bold">Courses</h2>
            <ol class="tw-list-decimal">
                <template x-for="(course, index) in courses">
                    <li x-text="course.name" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-p-2 tw-text-sm"
                        :class="index == currentCourseIndex ? 'tw-bg-gray-100' : ''"
                        @click="switchShow('courseDetails', index)"></li>
                </template>
            </ol>
            <button @click="switchShow('postForm', 'newCourse')" class="btn btn-primary tw-mt-4">
                <i class="fa fa-plus" aria-hidden="true"></i> Add Course
            </button>
        </div>
        <div class="tw-bg-white tw-p-4 tw-flex-grow">
            {{-- for new course --}}
            {{-- <template x-if="show.courseForm">
                <div class="tw-">
                    <h2 class="text-center">New Course</h2>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Course Name:</label>
                        <input type="email" class="form-control" x-model="courseForm.name"
                            placeholder="unique course name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Course Slug:</label>
                        <input type="email" class="form-control" x-model="courseForm.slug"
                            placeholder="unique slug for course">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Course Description:</label>
                        <textarea class="form-control" x-model="courseForm.description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Course Long-Description:</label>
                        <textarea class="form-control long_description" x-model="courseForm.long_description" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" @click="addCourse()" :disabled="loading">
                            <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            Save Course
                        </button>
                    </div>
                </div>
            </template> --}}
            {{-- for new subject --}}
            <div x-show="show.postForm" class="tw-">
                <h2 class="text-center tw-mb-4" x-html="formTitle">
                </h2>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        <span class="text-capitalize" x-text="currentType"></span> Name:
                    </label>
                    <input type="email" class="form-control" x-model="postForm.name"
                        :placeholder="`unique ${currentType} name`">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><span class="text-capitalize"
                            x-text="currentType"></span>
                        Slug:</label>
                    <input type="email" class="form-control" x-model="postForm.slug"
                        :placeholder="`unique slug for ${currentType}`">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"><span class="text-capitalize"
                            x-text="currentType"></span>
                        Description:</label>
                    <textarea class="form-control" x-model="postForm.description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"><span class="text-capitalize"
                            x-text="currentType"></span>
                        Long-Description:</label>
                    <textarea class="form-control long_description" x-model="postForm.long_description" rows="3"></textarea>
                </div>
                <select x-show="currentType == 'subject'" class="form-select mb-3" aria-label="Select course"
                    :disabled='true' x-model="postForm.course_id">
                    <option selected>Select a course</option>
                    <template x-for="course in courses">
                        <option :value="course.id" x-text="course.name"></option>
                    </template>
                </select>
                <div class="text-center">
                    <button class="btn btn-primary" @click="submitForm()" :disabled="loading">
                        <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span x-text="submitBtnText"></span>
                    </button>
                </div>
            </div>
            {{-- for details --}}
            <template x-if="show.courseDetails || show.subjectDetails">
                <div class="tw-flex tw-flex-col tw-justify-between" style="min-height: 100%">
                    <div class="">
                        <h2 class="text-center tw-font-bold" x-text="targetObject.name"></h2>
                        <p class="tw-pt-4" x-text="targetObject.description">
                        </p>
                        <p class="tw-mt-2">
                            <strong>
                                Slug:
                            </strong> <span x-text="targetObject.slug"></span>
                        </p>
                        <template x-if="show.courseDetails">
                            <div class="">
                                <h3 class="tw-mt-4 tw-font-bold">Subjects</h3>
                                {{-- list subjects --}}
                                <ol class="tw-list-decimal tw-m-4">
                                    <template x-for="(subject, index) in targetObject.subjects">
                                        <li x-text="subject.name" @click="switchShow('subjectDetails', index)"
                                            class="tw-cursor-pointer hover:tw-text-black hover:tw-underline tw-underline-offset-4">
                                        </li>
                                    </template>
                                </ol>
                                <template x-if="courses[currentCourseIndex].subjects.length == 0">
                                    <p class="tw-pb-4">
                                        The course '<span x-text="targetObject.name" class="tw-font-bold"></span>',
                                        does
                                        not
                                        have
                                        any
                                        subject yet.
                                    </p>
                                </template>
                            </div>
                        </template>
                        <template x-if="show.subjectDetails">
                            <p class="tw-mt-2 tw-mb-4">
                                <strong>
                                    Course ID:
                                </strong> <span x-text="targetObject.course_id"></span>
                            </p>
                        </template>
                        <div class="">
                            <span class="tw-font-bold">Long Description</span>
                            <p class="tw-pb-4" x-html="targetObject.long_description">
                            </p>
                        </div>
                    </div>
                    <div class="text-center">
                        {{-- only show add subject btn if on course details --}}
                        <template x-if="!show.subjectDetails">
                            <button class="btn btn-primary" @click="switchShow('postForm', 'newSubject')">
                                <span x-show="loading" class="spinner-border spinner-border-sm"
                                    aria-hidden="true"></span>
                                Add Subject
                            </button>
                        </template>
                        <button class="btn btn-outline-primary" @click="edit" :disabled="loading">
                            <span x-show="loading" class="spinner-border spinner-border-sm"
                                aria-hidden="true"></span>
                            Edit <span x-text="show.courseDetails? 'Course': 'Subject'"></span>
                        </button>
                        <button class="btn btn-danger" @click="remove()" :disabled="loading">
                            <span x-show="loading" class="spinner-border spinner-border-sm"
                                aria-hidden="true"></span>
                            Delete <span x-text="show.courseDetails? 'Course': 'Subject'"></span>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </section>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=aebyz7zeke446ygrs6h75wf7p21s7cprkwa7fl5cmrfwj6ly">
    </script>
    <script>
        tinymce.init({
            selector: '.long_description',
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
        const coursesJson = {{ Js::from($courses) }};
        window.onload = function() {
            /* setTimeout(() => {
                toastTrigger.click();
            }, 2000); */
        }

        // console.log(coursesJson);
        document.addEventListener('alpine:init', () => {
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
                courses: coursesJson,
                toastTrigger: toastTrigger,
                isEditingTarget: false,
                show: {
                    postForm: false,
                    courseDetails: false,
                    subjectDetails: false,
                },
                currentCourseIndex: 0,
                currentSubjectIndex: 0,
                targetObject: null,
                postFormCopy: null,
                postForm: {
                    id: null,
                    name: '',
                    slug: '',
                    description: '',
                    long_description: '',
                    course_id: null,
                },
                toastMessage: 'Hail Christ',
                currentType: 'Course',

                async init() {
                    this.switchShow('courseDetails', 0);
                },

                // GETTERS
                get formTitle() {
                    let title = this.isEditingTarget ? 'Editing ' : 'New ';
                    title += this.currentType;
                    title += this.currentType == 'subject' ? ` in <strong>${this.courses[this.currentCourseIndex]
                        .name}</strong>` :
                        '';
                    return title;
                },
                get submitBtnText() {
                    let text = this.isEditingTarget ? 'Update ' : 'Save ';
                    text += this.currentType;
                    return text;
                },

                // METHODS
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
                        if (index == 'newCourse' || index == 'newSubject') {
                            // const type = componentName.split('F')[0];
                            if (this[`${componentName}Copy`]) {
                                this[componentName] = this[`${componentName}Copy`];
                            }
                            this.resetObject(this[componentName]);
                            this.currentType = index == 'newCourse' ? 'course' : 'subject'
                            // set the course id for subject form
                            if (this.currentType == 'subject') {
                                this.postForm.course_id = this.courses[this.currentCourseIndex]
                                    .id;
                            }
                        } else if (componentName == 'courseDetails') {
                            this.currentType = 'course';
                            this.currentCourseIndex = index;
                            this.targetObject = this.courses[index];
                        } else { // it is course details
                            this.currentType = 'subject';
                            this.currentSubjectIndex = index;
                            this.targetObject = this.courses[this.currentCourseIndex].subjects[
                                index];
                        }
                    }
                    console.log('the current type is: ', this.currentType);
                },
                resetObject(obj) {
                    for (const field in obj) {
                        obj[field] = null;
                    }
                },
                async submitForm() {
                    // this.loading = true;
                    const isCourse = this.currentType == 'course';
                    const payload = this.postForm;
                    // set long_description
                    payload.long_description = tinymce.activeEditor.getContent();

                    const typeBaseName = `${this.currentType}s`;
                    let link = `/${typeBaseName}`;
                    const isEditing = payload.id;
                    if (isEditing) {
                        payload['_method'] = 'put';
                        link += `/${payload.id}`;
                    }
                    delete payload.subjects;
                    /* console.log(payload);
                    console.log(link);
                    return; */
                    try {
                        const response = await axios.post(link, payload);
                        console.log(response.data);
                        if (response.data) {
                            if (isCourse) {
                                if (isEditing) {
                                    this.courses[this.currentCourseIndex] = response.data.course;
                                } else {

                                    this.courses.push(response.data.course);
                                }
                                // show the course detial
                                this.switchShow('courseDetails', this.currentCourseIndex);
                            } else {
                                if (isEditing) {
                                    this.courses[this.currentCourseIndex].subjects[
                                        this.currentSubjectIndex] = response.data.subject;
                                    // show the subject detail
                                    this.switchShow('subjectDetails', this.currentSubjectIndex);
                                } else {
                                    this.courses[this.currentCourseIndex].subjects.push(response
                                        .data.subject);
                                    // show the course detial
                                    this.switchShow('courseDetails', this.currentCourseIndex);
                                }
                            }
                        }
                        this.toastMessage = response.data.message;
                        toastTrigger.click();
                    } catch (error) {
                        console.log('sorry an error occurred', error);
                    } finally {
                        this.loading = false;
                        this.isEditingTarget = false;
                        // const payload = type == 'course' ? this.resetObject(this.courseForm) : this
                        //     .resetObject(this.subjectForm);
                    }
                },

                edit() {
                    if (this.show.courseDetails) {
                        // copy course form if not yet copied
                        if (!this.postFormCopy) {
                            this.postFormCopy = structuredClone(this.postForm.target);
                        }
                        this.postForm = {
                            ...this.targetObject
                        }
                        // set postFormCopy to null since both course and subject are using it
                        this.postFormCopy = null;
                        this.switchShow('postForm');
                    } else {
                        // copy subject form if not yet copied
                        if (!this.postFormCopy) {
                            this.postFormCopy = structuredClone(this.postForm.target);
                        }
                        this.postForm = {
                            ...this.targetObject
                        }
                        // set postFormCopy to null since both course and subject are using it
                        this.postFormCopy = null;
                        this.switchShow('postForm');
                    }
                    this.isEditingTarget = true;
                    // set tinymce editor content if long_description is not null
                    const longDesc = this.targetObject.long_description ? this.targetObject
                        .long_description : ''
                    tinymce.activeEditor.setContent(longDesc);

                },
                // remove item
                async remove() {
                    const sure = confirm('Are you sure you want to delete this resources');
                    const isCourse = this.show.courseDetails;
                    let link = isCourse ? '/courses' : '/subjects';
                    link += '/' + this.targetObject.id;
                    /* if (!isCourse) {
                        console.log('about to delete subject');
                        const subjects = this.courses[this.currentCourseIndex].subjects.filter(
                            sub => sub.slug != this.targetObject.slug);
                        this.courses[this.currentCourseIndex].subjects = subjects;
                        console.log(subjects);
                        console.log('-----------------');
                        console.log(this.courses[this.currentCourseIndex].subjects);
                    }
                    return; */
                    if (sure) {
                        try {
                            const response = await axios.delete(link);
                            console.log(response.data);

                            this.toastMessage = response.data.message;
                            if (isCourse) {
                                const updatesCourseList = this.courses.filter((course) => course
                                    .id != this.targetObject.id);
                                this.courses = updatesCourseList;
                                if (updatesCourseList.length) {
                                    // if deleted course is the last on the list, show the one just above it
                                    if (this.currentCourseIndex >= updatesCourseList.length) {
                                        this.currentCourseIndex--;
                                        console.log('Course index', this.currentCourseIndex);
                                    }
                                    // show the course detial
                                    this.switchShow('courseDetails', this.currentCourseIndex);
                                } else {
                                    this.switchShow('courseForm', 'new');
                                }
                            } else {
                                const updatesSubjectList = this.courses[this.currentCourseIndex]
                                    .subjects.filter(sub => sub.slug != this.targetObject.slug);
                                this.courses[this.currentCourseIndex].subjects = updatesSubjectList;
                                // show the course detial
                                this.switchShow('courseDetails', this.currentCourseIndex);
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
