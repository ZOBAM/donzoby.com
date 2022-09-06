<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\{Post,Post_image,User,Group};

class PostController extends Controller
{

        public function __construct()
        {
            $this->middleware('auth');
        }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        function truncate($input, $numWords){
          if(str_word_count($input,0)>$numWords)
          {
            $WordKey = str_word_count($input,1);
            $PosKey = str_word_count($input,2);
            reset($PosKey);
            foreach($WordKey as $key => &$value)
            {
                $value=key($PosKey);
                next($PosKey);
            }
            return substr($input,0,$WordKey[$numWords]);
          }
          else {return $input;}
        }

        //fetch post from db and get excerpts
        $posts = Post::where('author_id','=',Auth::id())->orderBy('created_at','DESC')->paginate(10);
        if(count($posts)>0){
            $i = 0;
            foreach($posts as $data){
                $desc = $posts[$i]->post_content;
                $posts[$i]->post_content = truncate(strip_tags($desc),20);
                $i++;
            }
        }

        return view("/member", compact('posts'))->with('view','posts');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $view = "create";
        $groups = Group::get();
        return view("/member",compact('view','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course'        => 'required|min:7|max:20',
            'post_type'     => 'sometimes|min:5|max:20',
            'subject'       => 'required|min:3|max:20',
            'topic'         => 'required|min:7|max:200',
            'group'         => 'sometimes|min:0|max:200',
            'post_content'  => 'required|min:200',
            'post_status'   => 'required',
            'post_tags'     => 'required|min:4|max:200',
            'post_desc'     => 'required|min:30|max:1500',
            'picture.*'     => 'image|mimes:jpeg,png,jpg|max:250',
        ]);

            $post = new Post;
            $post->author_id        = Auth::id();
            $post->course           = $request->course;
            $post->post_type        = $request->post_type;
            $post->subject          = $request->subject;
            $post->post_topic       = $request->topic;
            $post->post_content     = $request->post_content;
            $post->post_status      = $request->post_status;
            $post->post_tags        = $request->post_tags;
            $post->post_description = $request->post_desc;

            if ($post->save()) {
                //save the group information
                if($request->has('group')){
                    if($request->group == 0){
                        $group = new Group;
                        $group->group_name = $post->post_topic;
                        $group->posts_ids = $post->id;
                    }
                    else{
                        $group = Group::where('id', $request->group)->first();
                        $group->posts_ids .= ',' . $post->id;
                    }
                    $group->save();
                    $post->group_id = $group->id;
                    $post->save();
                }//end request has group
                //increment user post count
                $user = User::find(Auth::id());
                $user->post_count =  (($user->post_count+1));//increment sagged items
                $user->save();
                //fectch image link form post content and save in the database
                $num_images = preg_match_all('/src="([^"]+.[^s])"/i', $request->post_content, $matches);
                $link_matches = $matches[1];
                if ($num_images>0) {
                    foreach ($link_matches as $image) {
                        //$image = str_replace("../","",$image);
                        $unique_name = "dzb_".str_pad($post->id,5,"0",STR_PAD_LEFT)."_";

                        $post_image = new Post_image;
                        $prev_img_url = $image;
                        $rel_img_url = str_replace("courses", "courses/".str_replace(' ','-',$post->subject), $prev_img_url);
                        $rel_img_url = str_replace("dzb_00000_", $unique_name, $rel_img_url);

                        //absolute url will be in the post content
                        $abs_img_url = URL(str_replace("../","",$rel_img_url));
                        //$post->post_content = $image."\n".$post->post_content;
                        $post->post_content = str_replace($image, $abs_img_url, $post->post_content);
                        $post->save();

                        //$rel_img_url1 = $rel_img_url;
                        $rel_img_url_for_db = str_replace('../','',$rel_img_url);
                        $post_image->link = $rel_img_url_for_db;
                        $post_image->post_id = $post->id;
                        $post_image->user_id = Auth::id();
                        $post_image->save();
                        $post->subject = str_replace(" ", "-", $post->subject);
                        //return 'rel_img_url with public_path: '.public_path('../../public/'.$rel_img_url_for_db).'<hr> rel_img_url without public_path: '.$rel_img_url.' <b>prev version </b>'.$rel_img_url1.'<hr> prev img url path: '.str_replace('../','../../public/',$prev_img_url);
                        //return URL($images_path."courses/".$post->subject);

                        //specify imgages directory first for development and then for production
                        $images_path = (is_dir(public_path('../../public/images/')))? '../../public/images/':'images/' ;
                        $public_path = (is_dir(public_path('../../public/')))? '../../public/':'';
                        if (!is_dir(URL($images_path."courses/".$post->subject))) {
                            mkdir(URL($images_path."courses/".$post->subject));
                        }
                        if(is_dir(public_path('../../public/images/'))){
                            rename(public_path(str_replace('../',$public_path,$prev_img_url)), public_path($public_path.$rel_img_url_for_db));
                        }
                        else{
                            rename((str_replace('../',$public_path,$prev_img_url)), ($public_path.$rel_img_url_for_db));
                        }
                    }
                }
            }


            return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        $view = "post";
        return view('/member',compact('post','view'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $view = "edit-post";
        return view('/member',compact('post','view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//----------------Save Edit---------------------------
    {
        //
        $this->validate($request, [
        'course' => 'required|min:7|max:20',
        'subject' => 'required|min:3|max:20',
        'topic' => 'required|min:7|max:200',
        'post_content' => 'required|min:200',
        'post_status' => 'required',
        'post_tags' => 'required|min:4|max:200',
        'post_desc' => 'required|min:30|max:500',
        ]);

        $post = Post::find($id);
        $old_subject = str_replace(" ", "-", $post->subject);
        $new_subject = str_replace(" ", "-", $request->subject);
        $subject_changed = ($new_subject != $old_subject)? true:false;

        $post->course = $request->course;
        $post->subject = $request->subject;
        $post->post_topic = $request->topic;
        $post->post_content = $request->post_content;
        $post->post_status = $request->post_status;
        $post->post_tags = $request->post_tags;
        $post->post_description = $request->post_desc;

        if ($subject_changed) {//replace old subject if subject was changed during edit
            $post->post_content = str_replace("/images/courses/$old_subject/", "/images/courses/$new_subject/", $post->post_content);
            $post->save();
        }
        //specify imgages directory first for development and then for production
        $images_path = (is_dir(public_path('../../public/images/')))? '../../public/images/':'images/' ;
        $public_path = (is_dir(public_path('../../public/')))? '../../public/':'';
        $is_dev_env = (is_dir(public_path('../../public/')))? true:false;
        //images saved in db
        $db_images = Post_image::where('post_id', $id)->get();if ($post->save()) {
        //check if image links are available in the post content
        $pattern = '/src="([^"]+.[^s])"/i';
        $num_images = preg_match_all($pattern, $request->post_content, $matches);
        $link_matches = $matches[1];

            if ($num_images>0) { //there are matches for image link
                // ----------------loop thru and change img url to absolute url----------------//
                foreach ($link_matches as $posted_link) {//loop thru & replace ../image with www.domain/image
                    $pattern = '/[\.\.]+\//';
                    $abs_img_url = URL(preg_replace($pattern, "", $posted_link));
                    if ($subject_changed) {//update post image url if subjected was changed
                        $abs_img_url = str_replace($old_subject, $new_subject, $abs_img_url);
                        $posted_link = str_replace($old_subject, $new_subject, $posted_link);
                    }
                    $post->post_content = str_replace($posted_link, $abs_img_url, $post->post_content);
                    $post->save();
                }//end ----------------loop thru and change img url to absolute url----------------//

                $saved_images = array();//an array that will hold saved images to avoid reprocessing them
                if (count($db_images)>0) {//there are images in db for this post
                    foreach ($db_images as $image) {
                        $db_image = $image->link;
                        $course_image = preg_replace('/courses\/[a-z]+.+?\//i', "courses/", $db_image);
                        /*check if img fetched in d db is still part of post content
                        also check if the uploaded file is still in the courses folder*/
                        //$edited_db_img_url = "../../public/".$db_image;
                        $edited_db_img_url = "../../public/".$db_image;

                        if (in_array($edited_db_img_url, $link_matches) ) {//db image is in matched links
                            if ($subject_changed) {
                                $pattern = '/courses\/[a-z-]+\//i';
                                $new_db_image = preg_replace($pattern, "courses/$new_subject/", $db_image);
                                $new_post_image = Post_image::find($image->id);
                                $new_post_image->link = $new_db_image;
                                $new_post_image->save();
                                if($is_dev_env){//path specific to dev environment
                                    if (!is_dir(public_path($images_path."courses/$new_subject"))) {
                                     mkdir(public_path($images_path."courses/$new_subject"));
                                    }
                                    rename(public_path($public_path.$db_image), public_path($public_path.$new_db_image));
                                }
                                else{
                                    if (!is_dir($images_path."courses/$new_subject")) {
                                     mkdir($images_path."courses/$new_subject");
                                    }
                                    rename($public_path.$db_image, $public_path.$new_db_image);
                                }
                            }
                            $saved_images[]= $edited_db_img_url;
                        }
                        else{//delete image if it's in db but no more in post content
                            if(strpos($post->post_content,$db_image )==false){
                               if(Post_image::destroy($image->id)){
                                    $db_image = preg_replace('/[^a-z\/\"]([\.\.\/])\//', "", $db_image);
                                    if($is_dev_env){
                                        if(file_exists(public_path($public_path.$db_image))) {
                                        unlink(public_path($public_path.$db_image));
                                        }
                                    }
                                    else{
                                        if(file_exists($public_path.$db_image)) {
                                        unlink($public_path.$db_image);
                                        }
                                    }
                                }
                            }

                        }//end else
                    }
                }//end if db image was > 0

                foreach ($link_matches as $posted_image) {
                    //replace "courses/subject/" with "courses/"
                   $course_image = preg_replace('/courses\/[a-z]+.+?\//i', "courses/", $posted_image);
                   //replace "../../public/image/" with "image/"

                   $course_image = preg_replace('/[^a-z\/\"]([\.\.\/])+\//', "",$course_image);
                    if (!in_array($posted_image, $saved_images) ) {//means posted_image is a new image
                        //return $course_image;
                        $file_exists = $is_dev_env? file_exists(public_path($public_path.$course_image)) : file_exists($public_path.$course_image);
                        if($file_exists) {
                            $pattern = '/[^a-z\/\"]([\.\.\/])+\/images\/courses\//';
                            $new_subject = str_replace(" ", "-", $new_subject);//replace space in directory name
                            $rel_img_url = preg_replace($pattern, "images/courses/$new_subject/",$posted_image);
                            $unique_name = "dzb_".str_pad($post->id,5,"0",STR_PAD_LEFT)."_";
                            $rel_img_url = str_replace("dzb_00000_", $unique_name, $rel_img_url);
                            //return $rel_img_url;

                            $post->post_content = str_replace($course_image, $rel_img_url, $post->post_content);
                            $post->save();
                            $post_image = new Post_image;
                            $post_image->link = $rel_img_url;
                            $post_image->dump = "New image added: ".$posted_image."\n Num saved_images: ".count($saved_images);
                            $post_image->user_id = Auth::id();
                            $post_image->post_id = $id;
                            $post_image->save();
                            if($is_dev_env){
                                if (!is_dir(public_path($images_path."courses/$new_subject"))) {
                                    mkdir(public_path($images_path."courses/$new_subject"));
                                }
                                rename(public_path($public_path.$course_image), public_path($public_path.$rel_img_url));
                            }
                            else{
                                if (!is_dir($images_path."courses/$new_subject")) {
                                    mkdir($images_path."courses/$new_subject");
                                }
                                rename($public_path.$course_image, $public_path.$rel_img_url);
                            }
                        }

                    }
                   else{
                   /* $post_image = new Post_image;
                    $post_image->dump = "This image is already in db:".$posted_image;
                    $post_image->link = $saved_images[0]."\n No saved_images: ".count($saved_images);
                    $post_image->user_id = Auth::id();
                    $post_image->post_id = $id;
                    $post_image->save();*/
                   }
                }
            }//end if there are matches for images links
            else{//there is no image links in the post content
                    if (count($db_images)>0) {//check if there are orphaned image link in db and dir & clear
                        foreach ($db_images as $image) {
                            if(Post_image::destroy($image->id)){
                                if($is_dev_env){
                                    if(file_exists(public_path($public_path.$image->link))) {
                                        unlink(public_path($public_path.$image->link));
                                    }
                                }
                                else{
                                    if(file_exists($public_path.$image->link)) {
                                        unlink($public_path.$image->link);
                                    }
                                }
                            }
                        }
                    }
                }
        return redirect('/post');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //specify imgages directory first for development and then for production
        $images_path = (is_dir(public_path('../../public/images/')))? '../../public/images/':'images/' ;
        $public_path = (is_dir(public_path('../../public/')))? '../../public/':'';
        $is_dev_env = (is_dir(public_path('../../public/')))? true:false;
        $user = User::find(Auth::id());
        $post_img = Post_image::where('post_id', $id)->get();
        //delete id from the ids in group
        $post = Post::findOrFail($id);
        if($post->group_id){
            $group = Group::find($post->group_id);
            $posts_ids_arr = explode(',',$group->posts_ids);
            foreach($posts_ids_arr as $key => $post_id){
                if($post_id == $id){
                    unset($posts_ids_arr[$key]);
                }
            }
            //delete the group if the just deleted id is the last in the group
            if(count($posts_ids_arr == 0)){}
            $group->posts_ids = implode(',',$posts_ids_arr);
            $group->save();
            //return implode(',',$posts_ids_arr);
            return count($posts_ids_arr);
        }
        //delete the post from db, clear img links from db, and then delete files files from server.
        if(Post::destroy($id)){
           $user->post_count =  ($user->post_count-1);//decrement sagged items
           $user->save();
           if (count($post_img)>0) {
               foreach ($post_img as $image) {
                $image = $image->link;
                if($is_dev_env){
                    if (file_exists(public_path($public_path.$image))) {
                    unlink(public_path($public_path.$image));
                    }
                }
                else{
                    if (file_exists($public_path.$image)) {
                    unlink($public_path.$image);
                    }
                }
              }
           }

        return back()->with('post_delete_success',true);
        }
    }
}
