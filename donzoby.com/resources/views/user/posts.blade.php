<x-user-layout>
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
                        <td>{{ $post->course }}</td>
                        <td>{{ $post->subject }}
                            <br><a href="{{ url('post/' . $post->id) }}"> Preview <i class="fa fa-expand"></i></a>
                        </td>
                        <td>{{ $post->post_topic }}</td>
                        <td>{!! $post->post_content !!} </td>
                        <td>{!! Str::words($post->post_description, '25') !!}<br> <i>Written
                                on:{{ date('M d, Y', strtotime($post->created_at)) }}</i></td>
                        <td>
                            <a href="{{ url('post/' . $post->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a>
                            <form method="POST" action="{{ url('post/' . $post->id) }}">
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
