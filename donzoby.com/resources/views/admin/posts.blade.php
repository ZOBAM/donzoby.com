<x-user-layout>
    {{-- Display Delete notification --}}
    @if (session()->has('post_delete_success'))
        <div class="alert alert-success" role="alert">
            <h3> Post successfully deleted!</h3>
        </div>
    @endif
    @if (session()->has('post_delete_error'))
        <div class="alert alert-danger" role="alert">
            <h3> {{ session('post_delete_error') }}</h3>
        </div>
    @endif

    <h1 class="text-center">All Posts</h1>
    @if (count($posts) > 0)
        <?php
        $pageNo = 0;
        if (isset($_GET['page'])) {
            $pageNo = $_GET['page'] - 1;
        }
        $nos = 1;
        ?>
        <div x-data="post" class="table-responsive tw-text-sm">
            <table class="table">
                <?php ?> <!-- initiate no for numbering the list -->
                <tr>
                    <th colspan="7" class="text-center"><i class="fa fa-home" style="color: green"></i> List of your
                        written Posts<sup>({{ $posts->total() }})</sup></th>
                </tr>

                <tr>
                    <th>S/N</th>
                    <th>Course</th>
                    <th>Subject</th>
                    <th>Topic</th>
                    <th>Post Content</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $pageNo * 10 + $nos++ }}</td>
                        <td>{{ $post->subject->course->name }}</td>
                        <td>{{ $post->subject->name }}
                            <br><a href="{{ url('post/' . $post->id) }}"> Preview <i class="fa fa-expand"></i></a>
                        </td>
                        <td>
                            {{ $post->topic }} <br>
                            <div class="tw-border tw-p-1 tw-bg-gray-100">
                                <span class="tw-text-xs">Change sort value</span> <br>
                                <div class="tw-text-2xl tw-flex tw-justify-between tw-items-center">
                                    <i class="fa fa-caret-down tw-cursor-pointer hover:tw-text-blue-600"
                                        @click="updateSortValue({{ $post->id }}, 'down')"></i>
                                    <i class="fa fa-caret-up tw-ml-3 tw-cursor-pointer hover:tw-text-blue-600"
                                        @click="updateSortValue({{ $post->id }}, 'up')"></i>
                                    <span
                                        class="tw-p-1 tw-text-white tw-bg-gray-500 tw-text-xs tw-rounded">{{ $post->sort_value }}</span>
                                </div>
                            </div>
                            @if ($post->is_parent)
                                <hr class="tw-mb-2">
                                <span class="tw-px-2 tw-py-1 tw-bg-gray-200 tw-rounded-md">Parent</span>
                            @endif
                            @if ($post->is_child)
                                <hr class="tw-mb-2">
                                <span class="tw-px-2 tw-py-[0.5] tw-border-2 tw-border-200 tw-rounded-md">Child</span>
                            @endif
                        </td>
                        <td>{!! $post->content !!} </td>
                        <td>{!! Str::words($post->description, '25') !!}
                            <p class="tw-mt-1 tw-bg-gray-300 tw-p-1">
                                <i>Written
                                    on: {{ date('M d, Y', strtotime($post->created_at)) }}</i>
                            </p>
                        </td>
                        <td>
                            <a href="{{ url('posts/' . $post->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a>
                            <form method="POST" action="{{ url('posts/' . $post->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <!-- <input type= "hidden" name="_method" value ="DELETE"> -->
                                <button
                                    onclick = 'return confirm("{{ Auth::user()->name }}, do you want to delete this Post? Click OK to delete or CANCEL to return")'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $posts->links() }}
            {{-- bs toast --}}
            @include('bs-toast')
        </div>
    @else
        Your post will be listed here soon when you write posts.
    @endif
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

            Alpine.data('post', () => ({
                loading: false,
                postForm: {
                    post_id: null,
                    sort_direction: null,
                },
                toastMessage: 'Hail Christ',
                isEditing: false,

                async init() {
                    // console.log('post alpine initiated');
                },

                // Getters
                get subjects() {},
                async updateSortValue(postID, direction) {
                    this.postForm.sort_direction = direction;
                    this.postForm.post_id = postID;
                    console.log(this.postForm);
                    // return;
                    this.loading = true;
                    const payload = this.postForm;
                    let link = '/posts/' + postID;
                    payload['_method'] = 'put';
                    console.log(payload);
                    try {
                        const {
                            data
                        } = await axios.post(link, payload);
                        console.log(data);
                        console.log('message::', data.message);
                        this.toastMessage = data.message;
                        setTimeout(() => {
                            // location.reload();
                        }, 2500);
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
