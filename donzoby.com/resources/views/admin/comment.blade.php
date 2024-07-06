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
        <h1 class="text-center">Users' Comments</h1>
        @if (count($comments) > 0)
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
                            users' comments<sup>({{ $comments->total() }})</sup></th>
                    </tr>
                    <tr>
                        <th>S/N</th>
                        <th>User Info</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $pageNo * 10 + $nos++ }}</td>
                            <td>
                                {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                                ({{ $comment->user->email }})
                            </td>
                            <td>
                                {{ $comment->content }}
                            </td>
                            <td>
                                @if ($comment->status == 'approved')
                                    <span class="badge text-bg-success">approved</span>
                                @else
                                    <span class="badge text-bg-secondary">unapproved</span>
                                @endif
                            </td>
                            <td><i>{{ date('M d, Y', strtotime($comment->created_at)) }}</i></td>
                            <td>
                                <a class="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                                    aria-controls="offcanvasExample" @click="edit({{ $comment->id }})"><i
                                        class="fa fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ url('comments/' . $comment->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <!-- <input type= "hidden" name="_method" value ="DELETE"> -->
                                    <button
                                        onclick = 'return confirm("{{ Auth::user()->name }}, do you want to delete this Comment? Click OK to delete or CANCEL to return")'>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $comments->links() }}
            </div>
        @else
            Your users' comments will be listed here soon when they write comments.
        @endif
        <hr>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title tw-font-bold" id="offcanvasExampleLabel"
                    x-text="currentComment? `${currentComment.user.first_name}'s Comment` : 'null'"></h5>
                <button @click="reloadPage" type="button" class="btn-close" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                {{-- post topic --}}
                <div class="tw-mb-5">
                    <span class="form-label tw-bg-gray-200 tw-p-1 tw-rounded">Post topic:</span>
                    <div class="tw-max-w-80 tw-mt-1">
                        <span x-text="currentComment?.post.topic"></span>
                    </div>
                </div>
                {{-- email --}}
                <div class="tw-mb-5">
                    <span class="form-label tw-bg-gray-200 tw-p-1 tw-rounded">Commenter email:</span>
                    <div class="tw-max-w-80 tw-mt-1">
                        <span x-text="currentComment?.user.email"></span>
                    </div>
                </div>
                {{-- comment content --}}
                <div class="tw-mb-5">
                    <span class="form-label tw-bg-gray-200 tw-p-1 tw-rounded">Comment:</span>
                    <div class="tw-max-w-80 tw-mt-1">
                        <span x-text="currentComment?.content"></span>
                    </div>
                </div>
                {{-- status --}}
                <div class="tw-mb-5">
                    <div class="tw-flex tw-justify-between">
                        <label for="tel" class="form-label">Comment Status</label>
                    </div>
                    <div x-show="isEditing" class="tw-max-w-80">
                        <select class="form-select" x-model="commentForm.status" name="status"
                            aria-label="Select comment status">
                            <option value="" selected>No status</option>
                            <option value="approved">approved</option>
                            <option value="unapproved">unapproved</option>
                        </select>
                    </div>
                </div>
                {{-- update button --}}
                <div x-show="isEditing" class="mb-3 text-center">
                    <button @click="updateComment()" class="btn btn-primary">
                        <span x-show="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Update Comment Status
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
                    comments: {{ Js::from($comments) }},
                    currentComment: null,
                    commentForm: {
                        comment_id: null,
                        status: null,
                        content: '',
                    },
                    toastMessage: 'Hail Christ',

                    async init() {
                        console.log(this.comments.data.length);
                    },

                    // GETTERS
                    get userFullName() {
                        let name = this.currentUser?.user.first_name;
                        name += this.currentUser?.user.last_name ?
                            ` ${this.currentUser?.user.last_name}` : '';
                        return name;
                    },

                    // METHODS
                    async edit(commentID) {
                        this.currentComment = this.comments.data.find(comment => comment.id ==
                            commentID);
                        this.commentForm.status = this.currentComment.status;
                        this.commentForm.content = this.currentComment.content;
                        this.commentForm.comment_id = this.currentComment.id;
                        this.isEditing = true;
                    },
                    reloadPage() {
                        location.reload();
                    },
                    async updateComment() {
                        this.loading = true;
                        this.commentForm['_method'] = 'put';
                        try {
                            console.log(this.commentForm);
                            const {
                                data
                            } = await axios.post('/comments/' + this.commentForm.comment_id, this
                                .commentForm);
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
