<x-user-layout>
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

    <h1 class="text-center">All Posts</h1>
    @if (count($posts) > 0)
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
                    <th colspan="7" class="text-center"><i class="fa fa-home" style="color: green"></i> List of your
                        written Posts<sup>({{ count($posts) }})</sup></th>
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
                            {{ $post->topic }}
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
                        <td>{!! Str::words($post->description, '25') !!}<br> <i>Written
                                on:{{ date('M d, Y', strtotime($post->created_at)) }}</i></td>
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
        </div>
    @else
        Your post will be listed here soon when you write posts.
    @endif
</x-user-layout>
