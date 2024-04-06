<x-user-layout>
    <h1 class="text-center tw-my-4">Write a New Post</h1>
    <div x-data="{}"><button x-on:click="$store.post.greet()">Increment</button></div>
    <form action="{{ url('posts') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Course</label>
                    <select class="form-select" name="course" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Subject</label>
                    <select class="form-select" name="subject" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Topic</label>
                    <input type="email" name="topic" class="form-control" id="exampleFormControlInput1"
                        placeholder="give it some title">
                </div>
            </div>
            <div class="col col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Type</label>
                    <select class="form-select" name="type" aria-label="Default select example">
                        <option value="1">Course</option>
                        <option value="2">Special Series</option>
                        <option value="3">How Tos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-3 tw-flex tw-items-end">
                <div class="mb-3 form-check form-switch tw-flex tw-justify-center tw-items-center tw-pb-3">
                    <input class="form-check-input" name="is_child" type="checkbox" role="switch"
                        id="flexSwitchCheckDefault">
                    <label class="form-check-label tw-ml-1" for="flexSwitchCheckDefault">Is Child</label>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Select Parent</label>
                    <select class="form-select" name="parent" aria-label="Default select example">
                        <option value="1">Course</option>
                        <option value="2">Special Series</option>
                        <option value="3">How Tos</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-3 tw-flex tw-items-end">
                <div class="mb-3 form-check form-switch tw-flex tw-justify-center tw-items-center tw-pb-3">
                    <input class="form-check-input" name="published" type="checkbox" role="switch"
                        id="flexSwitchCheckDefault2">
                    <label class="form-check-label tw-ml-1" for="flexSwitchCheckDefault2">Publish Now</label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Body</label>
            <textarea class="form-control" name="post_content" id="post_content" rows="15"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tags</label>
            <input type="email" name="tags" class="form-control" id="exampleFormControlInput1"
                placeholder="post tags">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Description/Excerpt</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
        <div class="mb-3 text-center">
            <button class="btn btn-primary">Submit Post</button>
        </div>
    </form>
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
        window.onload = function() {
            Alpine.store('post', {
                loadingSubjects: false,

                greet() {
                    alert('greeting you from alpine store');
                }
            });
        }
    </script>
</x-user-layout>
