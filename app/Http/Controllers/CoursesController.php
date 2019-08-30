<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\Profile_picture;
use App\Post_image;

class CoursesController extends Controller
{
    //
    public function index($course=1,$subject=2,$id=0,$topic="2")//{course}/{subject?}/{id?}/{topic?}
    {
    	$posts = Post::get()->take(12);
    	$listed_subjects;
    	foreach ($posts as $value) {//get array of fetched post's subjects
    		$listed_subjects[] = $value->subject;
    	}
    	$listed_subjects = array_unique($listed_subjects);//return unique subjects in the array

    	$course = strtolower($course);
    	$subject = strtolower($subject);

    	$courses_titles = array(//array of description for each of the courses
    		'graphics' => "Graphics Tutorials",
    		'web-design' => "Web Design Tutorials",
    		'web-dev' => "Web Development Tutorials",
    		'mobile-app-dev' => "Mobile App Development Tutorials",
    		'windows-dev' => "Windows App Development Tutorials",
    		'ms-office' => "Microsoft Office Tutorials ",
    		'office-operations' => "Office Operations Tutorials",
    		'internet-usage' => "Internet Usage Tutorials",
    		'mobile-usage' => "Mobile Phone Usage Tutorials"
    	);
    	$courses_descriptions = array(//array of description for each of the courses
    		'graphics' => "Learn how to create vector graphics and work with bitmap images on the computer. Everyday graphics skills is covered here. Design logos, crop and resize images etc. Gimp, Photoshop and CorelDraw are covered here.",
    		'web-design' => "Start learning how to design websites. Our course covers subjects like HTML, CSS, Bootstrap etc. and scripting languages such as JavaScript used for layout, formatting and animating web pages.",
    		'server-dev' => "Start learning server side programming for websites and manage website data using databases. Subjects covered here include: PHP, MySQL, SQL, Laravel etc.",
    		'mobile-app-dev' => "Learn the basics of building mobile applications on the Android platform and then advance to professional mobile app developer. Simple and easy Kotlin and Java tutorial for Android.",
    		'windows-dev' => "Learn how to build windows applications easily with care given to best practices. Start programming in C Sharp (C#) and Java by following our well written windows development course.",
    		'ms-office' => "Easy Microsoft Office tutorials that will help you accomplish important tasks easily at the office. Write and format letters, MOUs, make PowerPoint presentations, analyze results with Excel spreadsheet and manage data with Access.",
    		'office-operations' => "We want to make your life in the office lot easier with clearly illustrated tutorials on carrying out office tasks such as paper work and machine operations.",
    		'internet-usage' => "Donzoby gives you some common tips and tricks for making the most of the internet without wasting the whole day online.",
    		'mobile-usage' => "Donzoby mobile guide gives necessary tips to help you utilize the great features of your phones without losing a hair"
    	);
    	$subjects_descriptions = array(
    		'html'=> "Pages of Websites  are created with HTML. Learn practical HTML at Donzoby.com and build your first website in a short time.", 
    		'css'=> "Cascading Style Sheets control the look and feel of web documents. Learn how to write CSS formatting rules to tell browsers how to display web pages.", 
    		'javascript'=> "To make web pages come alive and respond to users immediately, you need JavaScript. We make learning JavaScript easy and less confusing at Donzoby.", 
    		'jquery'=> "jQuery is a JavaScript shortcut to the same destination. Learn how to enjoy the power of JavaScript without the pains of JavaScript in our jQuery tutorials.", 
    		'bootstrap'=> "Bootstrap is a framework for building responsive and mobile-first websites. It takes care of cross browsers CSS issues and many more stuffs. Quickly learn Bootstrap at Donzoby.com.",
    		'coreldraw'=> "Corel Draw is a comprehensive vector-based drawing program for the graphics professional. Unleash your artistic creativity by learning simple Corel Draw at Donzoby.", 
    		'photoshop'=> "Photoshop is the most popular and equally very powerful imaging and graphic design application. If you want to be able to retouch that family picture and much more, start learning Photoshop at Donzoby.", 
    		'gimp'=> "GIMP is a free image manipulation program. GIMP packs lots of features for picture editing but unlike Photoshop, you don't have to pay to use Gimp. Learn GIMP at Donzoby.",
    		'php'=> "In this course, you will learn how to use PHP one of the most popular languages for server side programming to create dynamic website that can accept and process user's input.", 
    		'sql'=> "The standard language for working with database is SQL which stands for Structured Query Language. You will learn how to write standard queries that can run across database systems.", 
    		'mysql'=> "MySQL is a Relational Database Management System(RDMS) that is free to use. We will show you to combine PHP and MySQL to build powerful websites.", 
    		'laravel'=> "Laravel is a PHP framework that simplifies the process of development with PHP. It makes your code more structured. Build your first Laravel website in a few and clear steps at Donzoby.com.",
    		'android-kotlin'=> "Kotlin is a Java like programming language that is compatible with the Android Operating System. Kotlin solves many problems that exist in Java and made it easier to accomplish tasks. Start Donzoby Kotlin tutorial to see it in action.", 
    		'android-java'=> "Java is a high level and platform independent programming language. You will learn how to use Java in building of Android apps.", 
    		'ios-swift'=> "",
    		'c-sharp'=> "Easy to understand C sharp (C Sharp #) tutorial for the beginners and new programmers at Donzoby.com.", 
    		'java'=> "Java is a high level and platform independent programming language. You will learn how to use Java in building of Android apps.",
    		'ms-word'=> "Learn Microsoft Word and format word documents with ease. MS Word is the world's most popular word processing software.", 
    		'ms-powerpoint'=> "Our PowerPoint tutorial will teach you how to prepare presentations for your meetings and conferences in easy steps.",
    		'ms-excel'=> "Learn Excel spreadsheet from the basics. Microsoft Excel is an interactive software for organization, analysis and storage of data in tabular form.", 
    		'ms-access'=> "Learn our Microsoft Access tutorial for beginners. Access is a Relational Database Management from Microsoft.",
    		'paper-work'=> "Practical guides on how to work with papers in small offices and computer business centers.", 
    		'machine-operations'=> "Practical guides on how to operate and work with common machines in small offices and computer business centers.",
    		'online-services'=> "In this tutorials, we will teach you how to use services online efficiently while avoiding risks.", 
    		'browsers'=> "Browsers are special computer programs that send requests to the server and process the server response to user readable formats. ", 
    		'miscellaneous'=> "Various topics on the use of internet and the world wide web are covered here to enable you browse the web effectively.",
    		'android-phones'=> "Learn about Android Phones, features, tricks and tips for effective use of your phones.", 
    		'iphones'=> "Learn about iPhones, features, tricks and tips for effective use of your phones.", 
    		'service-providers'=> "We bring you the latest on service providers' data plans, voice call tariffs, free YouTube sessions and much more.", 
    		'apps'=> "Learn to use the power of applications in your phone to solve daily problems and increase efficiency.", 
    		'hardware'=> "Get tips and ideas on how to care and prolong the lifespan of your phone. General guides and tips on phone hardware and accessories."
    	);
    	$subjects_titles = array(
    		'html'=> "HTML Tutorials", 
    		'css'=> "Cascading Style Sheets Tutorials", 
    		'javascript'=> "JavaScript Tutorials", 
    		'jquery'=> "jQuery Tutorials", 
    		'bootstrap'=> "Bootstrap Tutorials",
    		'coreldraw'=> "Corel Draw Tutorials", 
    		'photoshop'=> "Photoshop Tutorials", 
    		'gimp'=> "GIMP Tutorials",
    		'php'=> "PHP Tutorials", 
    		'sql'=> "Structured Query Language Tutorials", 
    		'mysql'=> "MySQL Tutorials", 
    		'laravel'=> "Laravel Tutorials",
    		'android-kotlin'=> "Android Kotlin Tutorials", 
    		'android-java'=> "Android Java Tutorials", 
    		'ios-swift'=> "",
    		'c-sharp'=> "C sharp (C Sharp #) Tutorials", 
    		'java'=> "Java Tutorials",
    		'ms-word'=> "Microsoft Word Tutorials", 
    		'ms-powerpoint'=> "PowerPoint Tutorials",
    		'ms-excel'=> "Microsoft Excel Tutorials", 
    		'ms-access'=> "Microsoft Access Tutorials",
    		'paper-work'=> "Paper Work Tutorials", 
    		'machine-operations'=> "Machines Operations Tutorials",
    		'online-services'=> "Online Services Tutorials", 
    		'browsers'=> "Browsers Tutorials", 
    		'miscellaneous'=> "Miscellaneous Internet Tutorials",
    		'android-phones'=> "Android Phones Tutorials", 
    		'iphones'=> "iPhones Tutorials", 
    		'service-providers'=> "Service Providers Tutorials", 
    		'apps'=> "Mobile App Usage Tutorials", 
    		'hardware'=> "Mobile Hardware Tutorials"
    	);


    	$courses = array('login', 'register','graphics', 'web-design', 'server-dev', 'mobile-app-dev', 'windows-dev', 'ms-office', 'office-operations', 'internet-usage', 'mobile-usage');//array of all courses
        if (in_array($course, $courses)) {//check if course in url is in array

        	$post_image = URL('public/images/dzb-'.$course.'.png');

            $subjects = array('html', 'css', 'javascript', 'jquery', 'bootstrap','coreldraw', 'photoshop', 'gimp','php', 'sql', 'mysql', 'laravel','android-kotlin', 'android-java', 'ios-swift','c-sharp', 'java','ms-word', 'ms-powerpoint','ms-excel', 'ms-access','paper-work', 'machine-operations','online-services', 'browsers', 'miscellaneous','android-phones', 'iphones', 'service-providers', 'apps', 'hardware');
            if (in_array($subject, $subjects)) {
                if ($id!=0) {//an id is provided
                    $topic = Post::findOrFail($id);
                    $topic->timestamps = false;//prevent updating of time stamps
                    $topic->post_hits = ++$topic->post_hits; $topic->save();
                    $post_image = Post_image::where('post_id',$id)->first();//get image for FB share
                    if ($post_image) {
                    	//$post_image = URL('public/images/donzoby-logo-wtbg.png');
                    	$post_image = URL('public/'.$post_image->link);                    	         	
                    }
                    else{
                    	$post_image = URL('public/images/donzoby-logo-wtbg.png');
                    }
                    $description = $topic->post_description;//meta description
                    $title = $topic->post_topic;//page title
                    $comments = Comment::where('comment_post_id',$id)->get();
                    if(count($comments)>0){
				    $i = 0;
				    foreach($comments as $comment){
				    	$comment_authors = User::where('id',$comment->user_id)->first();					
			    		$comments[$i]->author_name=$comment_authors->name;
			    		$author_image = Profile_picture::where('user_id',$comment_authors->id)->first();
			    		if ($author_image) {
			    			$comments[$i]->author_image_link=URL('public/'.$author_image->link);
			    		 }else{$comments[$i]->author_image_link=URL('public/images/donzoby-logo-wtbg.png');}
				    $i++;  
				    }//endforeach
				    }//endif
                    //$subject = 'HTML';
                    return view('courses.master',compact('topic','subject','posts','listed_subjects','comments','description','title','post_image'));
                }
                else{//invalid id provided, just list topics under the specified subject
                    $description = $subjects_descriptions[$subject];//meta description
                    $title = $subjects_titles[$subject];//page title
                    $subject_data = Post::where('subject','=',str_replace("-"," ",$subject))->get();
                    if(count($subject_data)<=0){
                        $subject_data = false;
                    }
                    return view('courses.master',compact('course','subject','subject_data','posts','listed_subjects','description','title','post_image'));
                }
            }
            else{//meaning the subject is not in array of subjects
            	$subject = '';
            	$description = $courses_descriptions[$course];
            	$title = $courses_titles[$course];//page title
                return view('courses.master',compact('course','subject','posts','listed_subjects','description','title','post_image'));
            }
        }
        else{//meaning the course is not in array of courses, return to home page
        	return view('dzb',compact('posts','listed_subjects'));
        }        
    }//end index  
}
