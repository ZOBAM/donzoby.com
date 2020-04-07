@extends('layouts/master')

@section('title')Donzoby Tech - Home @stop

@section('links')
    @include('layouts.member-links') 
    <script src="{{asset('public/js/course.js')}}" type="text/javascript"></script>
<!--  <script>
 tinymce.init({ 
 selector:'textarea',
 plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
             "save table contextmenu directionality emoticons template paste textcolor"
       ] });</script> -->
<script>
tinymce.init({
    selector: '#post_content',
    plugins: ["advlist autolink code link image lists charmap print preview hr anchor pagebreak spellchecker codesample"],
    toolbar: 'undo redo | image code link codesample | hr numlist bullist | aligncenter',
    
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: '/image-upload',
images_upload_handler: function (blobInfo, success, failure) {
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
</script>
@stop


@section('displayImage')
    @parent
@endsection

@section('mainContent')
<div class='container-fluid' id='main-content'>
    <div class="row">
    <div class="col-md-2" id="side-bar-links">

     <!--  very bad approach, change as soon as possible! -->
              @php
              $pic_link = URL('public/images/donzoby-logo-wtbg.png');
              @endphp
          @isset($profile_pic_link)
           @if(count($profile_pic_link)>0)
            @foreach($profile_pic_link as $link)
              @if($link->user_id == Auth::user()->id)
                @php
                $pic_link = 'public/'.$link->link;
                @endphp
              @endif
            @endforeach
           @endif
          @endisset
          <img src="{{URL($pic_link)}}" width='70%' class="img-responsive rounded-circle" alt="sliding display image"/>
            <div id="user-name">
                <p>{{ Auth::user()->name }}</p>
                <span id="join-date">Joined on {{ date("M d, Y",strtotime(Auth::user()->created_at)) }}</span><hr>
            </div>  
                  <!-- menu -->
              <div id="MainMenu" style="padding: 0">
                <div class="list-group panel" >

                  <a href="#profile" class="list-group-item  header" data-toggle="collapse" data-parent="#MainMenu">Profile  <i class="fa fa-caret-down"></i></a>
                  <div class="collapse" id="profile">
                    <a href="{{ url('/member/profile/view') }}" class="list-group-item">View </a>
                    <a href="{{ url('/member/profile/edit') }}" class="list-group-item">Edit Details</a>
                    <a href="{{ url('/member/profile/change-picture') }}" class="list-group-item">Change Picture</a>
                  </div>

                  <a href="#create" class="list-group-item  header" data-toggle="collapse" data-parent="#MainMenu">Create  <i class="fa fa-caret-down"></i><i class="fa fa-plus-square float-right"></i></a>
                  <div class="collapse" id="create">
                    <a href="{{ url('/post/create') }}" class="list-group-item">Post</a>
                    <a href="{{ url('/article/create') }}" class="list-group-item">Article</a>
                    <a href="{{ url('member/create/create-data-plan') }}" class="list-group-item">Data Plan</a>
                  </div>

                  <a href="#sagged-prop" class="list-group-item  header" data-toggle="collapse" data-parent="#MainMenu">Posts <i class="fa fa-caret-down"></i></a>
                  <div class="collapse" id="sagged-prop">
                    <a href="{{ url('/post') }}" class="list-group-item">Published Posts</a>
                    <a href="{{ url('/member/unpublished-post') }}" class="list-group-item">Unpublished Posts</a>
                  </div>

                  <a href="#sag-prop" class="list-group-item header " data-toggle="collapse" data-parent="#MainMenu">Articles <i class="fa fa-caret-down"></i></a>
                  <div class="collapse" id="sag-prop">
                    <a href="{{ url('member/published-articles') }}" class="list-group-item">Published Articles</a>
                    <a href="{{ url('member/unpublished-articles') }}" class="list-group-item">Unpublished Articles</a>
                  </div>

                </div>
              </div>
        </div>
    <div class = "col-md-10" id="center-col">  

<!---------------------- Display Delete notification ----------------------------------------------------->

            @if(session()->has('post_delete_success'))
            <h3> Post successfully deleted!</h3>
            @endif
<!---------------------- Display form to create new post ----------------------------------------------------->
<!---------------------- Display form to create new post ----------------------------------------------------->
        @isset($view)
        @if($view=='create') 
         <h1>Write a New Post</h1>
         @if(Auth::user()->id>1) <!-- we want to limit post creation to only the first registered user -->
         <h2>Welcome Dear Author</h2>
          <p>We are sorry but for now we are still working on our guest author feature. </p>
          <p>But you can get approval for writing by sending an mail to info@donzoby.com stating the topics you want to write on and other necessary details.</p>
          <p>Thanks for your kind understanding.<i class="fa fa-thumbs-up"></i></p>
          @else
         <form method="POST" action="{{ url('post') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="course" class="col-sm-2 col-form-label text-sm-right">{{ __('Course') }}</label>

                <div class="col-sm-8">
                    <select id="course" class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" value="{{ old('course') }}" required >
                        <option value="graphics">Graphics</option>    
                        <option value="web design">Web Design</option>
                        <option value="server dev">Server Dev.</option>    
                        <option value="mobile app dev">Mobile App Dev.</option>
                        <option value="windows dev">Windows Dev.</option>    
                        <option value="ms office">MS Office</option>
                        <option value="office operations">Office Operations</option> 
                        <option value="mobile usage">Mobile Usage</option>
                        <option value="internet usage">Internet Usage</option>  
                            
                            
                    </select>

                    @if ($errors->has('course'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('course') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="subject" class="col-sm-2 col-form-label text-sm-right">{{ __('Subject ') }}</label>

                <div class="col-sm-8">
                    <select id="subject" type="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}" >
                    <option value="">---Select a course first---</option>

                </select>

                    @if ($errors->has('subject'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="topic" class="col-sm-2 col-form-label text-sm-right">{{ __('Topic') }}</label>

                <div class="col-sm-8">
                    <input id="topic" type="text" class="form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}" name="topic" value="{{ old('topic') }}" required autofocus>

                    @if ($errors->has('topic'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('topic') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                        

            <div class="form-group row">
                <label for="post_content" class="col-sm-2 col-form-label text-sm-right">{{ __('Post Body') }}</label>

                <div class="col-sm-8">
                    <textarea  id="post_content" rows="19" type="text" class="form-control{{ $errors->has('post_content') ? ' is-invalid' : '' }}" name="post_content" >{{old('post_content') }}</textarea>

                    @if ($errors->has('post_content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('post_content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                  


            <div class="form-group row">
                <label for="post_tags" class="col-sm-2 col-form-label text-sm-right">{{ __('Tags') }}</label>

                <div class="col-sm-8">
                    <input id="post_tags" type="text" class="form-control{{ $errors->has('post_tags') ? ' is-invalid' : '' }}" name="post_tags" value="{{ old('post_tags') }}" required autofocus>

                    @if ($errors->has('post_tags'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('post_tags') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="post_desc" class="col-sm-2 col-form-label text-sm-right">{{ __('Post Description/Excerpt') }}</label>

                <div class="col-sm-8">
                    <textarea  id="post_desc" type="text" class="form-control{{ $errors->has('post_desc') ? ' is-invalid' : '' }}" name="post_desc"  required >{{ old('post_desc') }}</textarea>

                    @if ($errors->has('post_desc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('post_desc') }}</strong>
                        </span>{{ old('post_desc') }}
                    @endif
                </div>
            </div> 


            <div class="form-group row">
                <label for="post_status" class="col-sm-2 col-form-label text-sm-right">{{ __('Post Status') }}</label>

                <div class="col-sm-8">
                    <select id="post_status" class="form-control{{ $errors->has('post_status') ? ' is-invalid' : '' }}" name="post_status" value="{{ old('post_status') }}" required >
                        <option value="for rent">Publish Now</option>  <option value="for sale">Publish Later</option>
                    </select>

                    @if ($errors->has('post_status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('post_status') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-sm-6 offset-sm-4 text-right">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit Post') }} <i class="fa fa-save"></i>
                    </button>
                </div>
            </div>
         </form>
          @endif

    <!--------------------------- List out available posts by the member ------------------------------------->
        @elseif($view == 'create-data-plan')
        @include('data-plans')
    <!--------------------------- List out available posts by the member ------------------------------------->
    <!--------------------------- List out available posts by the member ------------------------------------->
         @elseif($view == 'posts' )
             @if(count($posts)>0)
             <?php 
             $pageNo = 0;
             if (isset($_GET['page'])) {
              $pageNo = $_GET['page']-1;
             }
             $nos = 1;
              ?>
                <div class="table-responsive">
            <table class="table">
                <?php  ?> <!-- initiate no for numbering the list -->
            <tr>
                <th colspan="7" class="text-center"><i class="fa fa-home" style="color: green"></i> List of your written Posts<sup>({{count($posts)}})</sup></th>
            </tr>

            <tr>
                <th>S/N</th> <th>Course</th> <th>Subject</th>   
                <th>Topic</th> <th>Post Content</th> <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach($posts as $post)
            <tr>
                <td>{{($pageNo*10) + $nos++}}</td> <td>{{$post->course}}</td> 
                <td>{{$post->subject}}
                  <br><a href="{{url('post/'.$post->id)}}"> Preview <i class="fa fa-expand"></i></a>
                </td>
                <td>{{$post->post_topic}}</td> 
                <td>{!! $post->post_content !!} </td>
                <td>{!! $post->post_description !!}<br>  <i>Written on:{{date("M d, Y",strtotime($post->created_at))}}</i></td>
                <td>
                    <a href="{{url('post/'.$post->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a>
                    <form method="POST" action="{{url('post/'.$post->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <!-- <input type= "hidden" name="_method" value ="DELETE"> -->
                <button onclick = 'return confirm("{{ Auth::user()->name }}, do you want to delete this Post? Click OK to delete or CANCEL to return")'>Delete</button>
            </form></td>
            </tr>
            @endforeach
                </table>
                {{ $posts->links() }}
            </div>
             @else
                Your post will be listed here soon when you write posts.
             @endif
    <!--------------------------- Display Selected post by the member ------------------------------------->
    <!--------------------------- Display Selected post by the member ------------------------------------->
         @elseif($view == 'post' )
                <h1>{{$post->post_topic}}</h1><i>Written on:{{date("M d, Y",strtotime($post->created_at))}}</i> 
                {!! $post->post_content !!}
                {!! $post->post_description !!}
                    <a href="{{url('post/'.$post->id.'/edit')}}"><i class="fa fa-edit"></i> Edit Post</a>
                    

<!------ Display form for editing selected post--------------------------------------------------- -->
<!------ Display form for editing selected post--------------------------------------------------- -->

        @elseif($view == "edit-post")

        <?php
        $num_images = preg_match_all('/src="([^"]+)"/i', $post->post_content, $matches); 
        //var_dump($matches);
        print_r($matches[1]);
        $db_image = "images/courses/MS PowerPoint/cocet.png";
        $my_str = '<p>You canYou can alwasy trust your life and everything into the hands of our ever caring Lord and savior. You can<img src="http://www.donzoby.net/public/images/courses/MS PowerPoint/cocet.png" alt="" width="268" height="129" /><img src="http://www.donzoby.net/public/images/courses/MS PowerPoint/kolic logo.png" alt="" width="266" height="270" /></p>';
        if(strpos($my_str,$db_image)==false){
          echo "<hr>String not found";
        }

        $str = 23;
        echo "<hr>".str_pad($str,5,"0",STR_PAD_LEFT);

        ?>
        <h1>Edit "{{$post->post_topic}}" Post</h1>

         <form method="POST" action="{{ url('post/'.$post->id) }}" >
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}

                        <div class="form-group row">
                            <label for="course" class="col-sm-2 col-form-label text-sm-right">{{ __('Course') }}</label>

                            <div class="col-sm-8">
                                <select id="course" class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" value="{{ old('course') }}" required >
                                    <option value="graphics">Graphics</option>    
                                    <option value="web design">Web Design</option>
                                    <option value="server dev">Server Dev.</option>    
                                    <option value="mobile app dev">Mobile App Dev.</option>
                                    <option value="windows dev">Windows Dev.</option>    
                                    <option value="ms office">MS Office</option>
                                    <option value="office operations">Office Operations</option> 
                                    <option value="mobile usage">Mobile Usage</option>
                                    <option value="internet usage">Internet Usage</option>  
                                        
                                        
                                </select>

                                @if ($errors->has('course'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('course') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-sm-2 col-form-label text-sm-right">{{ __('Subject ') }}</label>

                            <div class="col-sm-8">
                                <select id="subject" type="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}" >
                                <option value="">---Select a course first---</option>    

                            </select>

                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="topic" class="col-sm-2 col-form-label text-sm-right">{{ __('Topic') }}</label>

                            <div class="col-sm-8">
                                <input id="topic" type="text" class="form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}" name="topic" value="{{ count($errors) > 0 ? old('topic') : $post->post_topic }}" required autofocus>

                                @if ($errors->has('topic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group row">
                            <label for="post_content" class="col-sm-2 col-form-label text-sm-right">{{ __('Post Body') }}</label>

                            <div class="col-sm-8">
                                <textarea  id="post_content" rows="19" type="text" class="form-control{{ $errors->has('post_content') ? ' is-invalid' : '' }}" name="post_content"  required >{{count($errors) > 0 ? old('post_content') : $post->post_content }}</textarea>
                                @if ($errors->has('post_content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                  


                        <div class="form-group row">
                            <label for="post_tags" class="col-sm-2 col-form-label text-sm-right">{{ __('Tags') }}</label>

                            <div class="col-sm-8">
                                <input id="post_tags" type="text" class="form-control{{ $errors->has('post_tags') ? ' is-invalid' : '' }}" name="post_tags" value="{{ count($errors) > 0 ? old('post_tags') : $post->post_tags }}" required >

                                @if ($errors->has('post_tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_desc" class="col-sm-2 col-form-label text-sm-right">{{ __('Post Description/Excerpt') }}</label>

                            <div class="col-sm-8">
                                <textarea  id="post_desc" type="text" class="form-control{{ $errors->has('post_desc') ? ' is-invalid' : '' }}" name="post_desc"  required >{{ count($errors) > 0 ? old('post_content') : $post->post_description }}</textarea>

                                @if ($errors->has('post_desc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="post_status" class="col-sm-2 col-form-label text-sm-right">{{ __('Post Status') }}</label>

                            <div class="col-sm-8">
                                <select id="post_status" class="form-control{{ $errors->has('post_status') ? ' is-invalid' : '' }}" name="post_status" value="{{ old('post_status') }}" required >
                                    <option value="1">Publish Now</option>  <option value="0">Publish Later</option>
                                </select>

                                @if ($errors->has('post_status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-sm-6 offset-sm-4 text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Edit') }} <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </div>
         </form>

    <!----------------------- edit profile details ----------------------------------------------------->
    <!----------------------- edit profile details ----------------------------------------------------->
    @elseif($view=="edit_profile")
        @include('auth.profile-edit')
    <!----------------------- edit profile picture ----------------------------------------------------->
    <!----------------------- edit profile picture ----------------------------------------------------->
    @elseif($view=="change_picture")
        @include('auth.profile-picture-edit')

    <!----------------------- Display profile details ----------------------------------------------------->
    <!----------------------- Display profile details ----------------------------------------------------->
         @else
         <div id="profile-details">
                <div class="" id="sagged-no"><span style="font-size: 2em">{{ Auth::user()->post_count }}</span>  <br>Posts<br>Written</div><hr>
                <i> Your Details:</i> <br>
            Country: {{ Auth::user()->country }}<br>
            Email: {{ Auth::user()->email }}<br>
            Tel: {{ Auth::user()->tel }}<hr>
            </div>
        @endif
        @endisset
    </div>

    </div>

</div><!--main-content-->
@endsection

@section('bottomLinks')
@isset($post)
<script type="text/javascript">
function chooseCourse(){
     $('#course').val("{{$post->course}}");
    $('#course').click();
     $('#subject').val("{{$post->subject}}");
 }

 
 setTimeout(chooseCourse,1000);
$('#course').change();
</script>
@endisset
@endsection
