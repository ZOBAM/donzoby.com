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
        <div class="tw-px-4">
            <h2 class="tw-font-bold">Courses</h2>
            <ol class="tw-list-decimal">
                <template x-for="(course, index) in courses">
                    <li x-text="course.name" class="tw-cursor-pointer"
                        :class="index == currentCourseIndex ? 'tw-bg-green-400' : ''"
                        @click="switchShow('courseDetails', index)"></li>
                </template>
            </ol>
            <button @click="switchShow('courseForm', 'new')" class="btn btn-primary tw-mt-4">
                <i class="fa fa-plus" aria-hidden="true"></i> Add Course
            </button>
        </div>
        <div class="tw-bg-white tw-p-4 tw-flex-grow">
            {{-- for new course --}}
            <div x-show="show.courseForm" class="tw-">
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
                <div class="text-center">
                    <button class="btn btn-primary" @click="addCourse()" :disabled="loading">
                        <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Save Course
                    </button>
                </div>
            </div>
            {{-- for new subject --}}
            <div x-show="show.subjectForm" class="tw-">
                <h2 class="text-center">
                    <span x-text="isEditingTarget? 'Editing' : 'New'"></span> Subject in <span class="tw-font-bold"
                        x-text="courses[currentCourseIndex].name"></span>
                </h2>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Subject Name:</label>
                    <input type="email" class="form-control" x-model="subjectForm.name"
                        placeholder="unique subject name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Subject Slug:</label>
                    <input type="email" class="form-control" x-model="subjectForm.slug"
                        placeholder="unique slug for subject">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Subject Description:</label>
                    <textarea class="form-control" x-model="subjectForm.description" rows="3"></textarea>
                </div>
                <select class="form-select mb-3" aria-label="Select course" :disabled='true'
                    x-model="subjectForm.course_id">
                    <option selected>Select a course</option>
                    <template x-for="course in courses">
                        <option :value="course.id" x-text="course.name"></option>
                    </template>
                </select>
                <div class="text-center">
                    <button class="btn btn-primary" @click="addCourse('subject')" :disabled="loading">
                        <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Save Subject
                    </button>
                </div>
            </div>
            {{-- for details --}}
            <template x-if="show.courseDetails || show.subjectDetails">
                <div class="tw-">
                    <h2 class="text-center" x-text="targetObject.name"></h2>
                    <p class="tw-pt-4" x-text="targetObject.description">
                    </p>
                    <p class="tw-mt-2">
                        <strong>
                            Slug:
                        </strong> <span x-text="targetObject.slug">graphics</span>
                    </p>
                    <template x-if="show.courseDetails">
                        <div class="">
                            <h3 class="tw-mt-4 tw-font-bold">Subjects</h3>
                            {{-- list subjects --}}
                            <ol class="tw-list-decimal tw-m-4">
                                <template x-for="(subject, index) in targetObject.subjects">
                                    <li x-text="subject.name" @click="switchShow('subjectDetails', index)"
                                        class="tw-cursor-pointer"></li>
                                </template>
                            </ol>
                            <template x-if="courses[currentCourseIndex].subjects.length == 0">
                                <p class="tw-pb-4">
                                    The course '<span x-text="targetObject.name" class="tw-font-bold"></span>', does
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
                    <div class="text-center">
                        {{-- only show add subject btn if on course details --}}
                        <template x-if="!show.subjectDetails">
                            <button class="btn btn-primary" @click="switchShow('subjectForm', 'new')">
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
    <script>
        const coursesJson = {{ Js::from($courses) }};
        window.onload = function() {
            /* setTimeout(() => {
                toastTrigger.click();
            }, 2000); */
        }

        // console.log(coursesJson);
        document.addEventListener('alpine:init', () => {
            const toastTrigger = document.getElementById('liveToastBtn')
            const toastLiveExample = document.getElementById('liveToast')

            if (toastTrigger) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastTrigger.addEventListener('click', () => {
                    toastBootstrap.show()
                })
            }
            Alpine.data('course', () => ({
                loading: false,
                courses: coursesJson,
                toastTrigger: toastTrigger,
                isEditingTarget: false,
                show: {
                    courseForm: true,
                    subjectForm: false,
                    courseDetails: false,
                    subjectDetails: false,
                },
                currentCourseIndex: 0,
                currentSubjectIndex: 0,
                targetObject: null,
                courseForm: {
                    id: null,
                    name: '',
                    slug: '',
                    description: ''
                },
                courseFormCopy: null,
                subjectFormCopy: null,
                subjectForm: {
                    id: null,
                    name: '',
                    slug: '',
                    description: '',
                    course_id: null,
                },
                toastMessage: 'Hail Christ',

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
                        if (index == 'new') {
                            const type = componentName.split('F')[0];
                            if (this[`${type}FormCopy`]) {
                                this[componentName] = this[`${type}FormCopy`];
                            }
                            this.resetObject(this[componentName]);
                            // set the course id for subject form
                            if (componentName.indexOf('subject') != -1) {
                                this.subjectForm.course_id = this.courses[this.currentCourseIndex].id;
                            }
                        } else if (componentName == 'courseDetails') {
                            this.currentCourseIndex = index;
                            this.targetObject = this.courses[index];
                            console.log(':::::::::::::::::::::::::::::::');
                            console.log('this is the current course: ', this.targetObject);
                            console.log(':::::::::::::::::::::::::::::::');
                        } else {
                            this.currentSubjectIndex = index;
                            console.log(':::::::::::::::::::::::::::::::');
                            console.log('this is the currentSubject Index: ', this.currentSubjectIndex);
                            console.log('-------------------------------------');
                            this.targetObject = this.courses[this.currentCourseIndex].subjects[index];
                            console.log('this is the targetObject: ', this.targetObject);
                            console.log(':::::::::::::::::::::::::::::::');
                        }
                        // console.log(this.courses[index]);
                    }
                },
                resetObject(obj) {
                    for (const field in obj) {
                        obj[field] = null;
                    }
                },
                async addCourse(type = 'course') {
                    // this.loading = true;
                    const isCourse = type == 'course';
                    const payload = isCourse ? this.courseForm : this.subjectForm;
                    const typeBaseName = `${type}s`;
                    let link = `/${typeBaseName}`;
                    const isEditing = payload.id;
                    if (isEditing) {
                        payload['_method'] = 'put';
                        link += `/${payload.id}`;
                    }
                    console.log(payload);
                    // return;
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
                        if (!this.courseFormCopy) {
                            this.courseFormCopy = structuredClone(this.courseForm.target);
                        }
                        this.courseForm = {
                            ...this.targetObject
                        }
                        this.switchShow('courseForm');
                    } else {
                        // copy subject form if not yet copied
                        if (!this.subjectFormCopy) {
                            this.subjectFormCopy = structuredClone(this.subjectForm.target);
                        }
                        this.subjectForm = {
                            ...this.targetObject
                        }
                        this.switchShow('subjectForm');
                    }
                    this.isEditingTarget = true;
                },
                async remove() {
                    const sure = confirm('Are you sure you want to delete this resources');
                    const isCourse = this.show.courseDetails;
                    let link = isCourse ? '/courses' : '/subjects';
                    link += '/' + this.targetObject.id;
                    if (sure) {
                        try {
                            const response = await axios.delete(link);
                            console.log(response.data);

                            this.toastMessage = response.data.message;
                            if (isCourse) {
                                // show the course detial
                                this.switchShow('courseDetails');
                                const updatesCourseList = this.courses.filter((course) => course
                                    .id != this.targetObject.id);
                                this.courses = updatesCourseList;
                            } else {
                                // show the course detial
                                this.switchShow('courseDetails', this.currentCourseIndex);
                                const updatesSubjectList = this.courses[this.currentCourseIndex]
                                    .subjects.filter((sub) => sub.id != this.targetObject.id);
                                this.courses[this.currentCourseIndex].subjects = updatesSubjectList;
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
