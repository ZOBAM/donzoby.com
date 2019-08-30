<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Post;
use App\Post_image;
use App\User;

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
        //
        $posts = Post::where('author_id','=',Auth::id())->get();

        if(count($posts)>0){
            $i = 0;
            foreach($posts as $data){
                $desc = $posts[$i]->post_content;
                $posts[$i]->post_content = truncate(strip_tags($desc),20);
                $i++;
            }
        }

        return view("/home")->with('posts',$posts)->with('view','posts');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("/home")->with('view','create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'course' => 'required|min:7|max:20',
            'subject' => 'required|min:3|max:20',
            'topic' => 'required|min:7|max:200',
            'post_content' => 'required|min:200',
            'post_status' => 'required',
            'post_tags' => 'required|min:4|max:200',
            'post_desc' => 'required|min:30|max:1500',         
            'picture.*' => 'image|mimes:jpeg,png,jpg|max:250',
        ]);


        
            $post = new Post;
            $post->author_id = Auth::id();
            $post->course = $request->course;
            $post->subject = $request->subject;
            $post->post_topic = $request->topic;
            $post->post_content = $request->post_content;
            $post->post_status = $request->post_status;
            $post->post_tags = $request->post_tags;
            $post->post_description = $request->post_desc;

            

            if ($post->save()) {
                //increment user post count
                $user = User::find(Auth::id());
                $user->post_count =  (($user->post_count+1));//increment sagged items
                $user->save();

                //fectch image link form post content and save in the database
                $num_images = preg_match_all('/"\.+.+.\.(gif|jpe?g|png)"/i', $request->post_content, $matches);
                if ($num_images>0) {
                    foreach ($matches[0] as $image) {
                    $post_image = new Post_image;
                    $prev_img_url = str_replace("\"","",$image);//relative url will be saved in post img table
                    $rel_img_url = str_replace("courses", "courses/$post->subject", $prev_img_url);

                    $abs_img_url = '"'.URL($rel_img_url).'"'; //absolute url will be in the post content
                    $post->post_content = str_replace($image, $abs_img_url, $post->post_content);
                    $post->save();

                    $rel_img_url = substr($rel_img_url, 10);
                    $post_image->link = $rel_img_url;
                    $post_image->post_id = $post->id;
                    $post_image->user_id = Auth::id();
                    $post_image->save();
                    if (!is_dir(public_path("images/courses/$post->subject"))) {
                         mkdir(public_path("images/courses/$post->subject"));
                     } 
                    rename(public_path($prev_img_url), public_path($rel_img_url)); 
                    }
                }
            }
            

           //process uploaded images
            if ($request->hasFile('picture.*')){
                        foreach (request()->picture as $image) {
                            # code...
                        $Post_image = new Post_image;
            
                        $imageName = $post->post_topic.'_'.$image->getClientOriginalName().time().'.'.$image->getClientOriginalExtension();
                        $imagePath = 'images/'.$post->course.'/'.$post->subject;
                        $image->move(public_path($imagePath), $imageName);
            
                        $post_image->link = $imagePath."/".$imageName;
                        $post_image->user_id = Auth::id();
                        $post_image->post_id = $post->id;
            
                        $post_image->save();
                        }//end foreach
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
        return view('/home',compact('post','view'));
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
        return view('/home',compact('post','view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $post->course = $request->course;
        $post->subject = $request->subject;
        $post->post_topic = $request->topic;
        $post->post_content = $request->post_content;
        $post->post_status = $request->post_status;
        $post->post_tags = $request->post_tags;
        $post->post_description = $request->post_desc;
        

        if ($post->save()) {

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
        //
        $user = User::find(Auth::id());
        $post_img = Post_image::where('post_id', $id)->get();
        if(Post::destroy($id)){
           $user->post_count =  ($user->post_count-1);//decrement sagged items
           $user->save();
           if (count($post_img)>0) {
               foreach ($post_img as $image) {
                $image = $image->link;
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
               
              }
           }
           
        return back()->with('post_delete_success',true);
        }
    }
}
