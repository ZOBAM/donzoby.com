<x-user-layout>
    <h1 class="text-center tw-my-4">Write a New Post</h1>
    <section x-data="course">
        <form @submit.prevent="submitPost" action="{{ url('posts') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Course</label>
                        <select class="form-select" x-model="postForm.course_id" name="course"
                            aria-label="Default select example">
                            <option selected>Choose A Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Subject</label>
                        <select class="form-select" x-model="postForm.subject_id" name="subject"
                            aria-label="Default select example">
                            <option selected>Select Subject</option>
                            <template x-for="subject in subjects">
                                <option :value="subject.id" x-text="subject.name"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Topic</label>
                        <input type="text" x-model="postForm.topic" name="topic" class="form-control"
                            id="exampleFormControlInput1" placeholder="give it some title">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Type</label>
                        <select class="form-select" x-model="postForm.type" name="type"
                            aria-label="Default select example">
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
                            role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label tw-ml-1" for="flexSwitchCheckDefault">Is Child</label>
                    </div>
                </div>
                <div x-show="postForm.isChild" x-transition.duration.750ms class="col col-md-6">
                    <div class="mb-3">
                        {{-- <label for="exampleFormControlInput1" class="form-label">Select Parent Post</label> --}}
                        <select class="form-select" x-model="postForm.parent_id" name="parent"
                            aria-label="Default select example" :disabled="loading">
                            <option selected>Select Parent Post</option>
                            <template x-for="parent in postParents">
                                <option :value="parent.id" x-text="parent.topic"></option>
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
                <textarea class="form-control" x-model="postForm.content" name="post_content" id="post_content" rows="15"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tags</label>
                <input type="text" x-model="postForm.tags" name="tags" class="form-control"
                    id="exampleFormControlInput1" placeholder="post tags">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Description/Excerpt</label>
                <textarea class="form-control" x-model="postForm.description" name="description" id="exampleFormControlTextarea1"
                    rows="2"></textarea>
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-primary" :disabled="loading">
                    <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    Submit Post
                </button>
            </div>
        </form>
    </section>
    {{-- Add page specific JS --}}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=aebyz7zeke446ygrs6h75wf7p21s7cprkwa7fl5cmrfwj6ly">
    </script>
    <script>
        tinymce.init({
            selector: '#post_content',
            plugins: [
                "advlist autolink code link image lists charmap print preview hr anchor pagebreak spellchecker codesample"
            ],
            toolbar: 'undo redo | image code link codesample | hr numlist bullist | aligncenter',

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

            Alpine.data('course', () => ({
                loading: false,
                courses: {{ Js::from($courses) }},
                postParents: [],
                show: {
                    selectParent: false,
                    subjectForm: false,
                    courseDetails: false,
                    subjectDetails: false,
                },
                postForm: {
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
                toastMessage: 'Hail Christ',

                // Getters
                get subjects() {
                    if (!this.postForm.course_id) return [];
                    return this.courses.find(course => course.id == this.postForm.course_id)
                        .subjects;
                },

                async getPostParents() {
                    // only load parents when isChild
                    if (this.postForm.isChild) return;

                    console.log('>>>>', this.postForm.isChild);
                    this.loading = true;
                    try {
                        const {
                            data
                        } = await axios.get('/posts?parent=1');
                        this.postParents = data.parents;
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
                    try {
                        const {
                            data
                        } = await axios.post('/posts', this.postForm);
                        console.log(data);
                    } catch (error) {
                        console.log('Error submitting post: ', error);
                    } finally {
                        this.loading = false;
                    }
                }
            }));
        });
    </script>
</x-user-layout>
