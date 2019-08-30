<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_image;

class CoursesController2 extends Controller
{
    //
    public function index($course=1,$subject=2,$id=0,$topic="2")//{course}/{subject?}/{id?}/{topic?}
    {
    	$courses = array('login', 'register','graphics', 'webdesign', 'webdev', 'mobile-app-dev', 'windows-dev', 'msoffice', 'office-operations', 'internet-usage', 'mobile-usage');//array of all courses
        if (in_array($course, $courses)) {//check if course in url is in array

            $subjects = array('html', 'css', 'javascript', 'jquery', 'bootstrap','coreldraw', 'photoshop', 'gimp','php', 'sql', 'mysql', 'laravel','android-kotlin', 'android-java', 'ios-swift','c-sharp', 'java','ms-word', 'ms-powerpoint','ms-excel', 'ms-access','paper-work', 'machine-operations','online-services', 'browsers', 'miscellaneous','android-phones', 'iphones', 'service-providers', 'apps', 'hardware');
            if (in_array($subject, $subjects)) {
                if ($id!=0) {
                    $topic = Post::findOrFail($id);
                    //$subject = 'HTML';
                    return view('courses.master',compact('topic','subject'));
                }
                else{
                    //$subject = 'HTML';
                    $subject_data = Post::where('subject','=',$subject)->get();
                    if(count($subject_data)<=0){
                        $subject_data = false;
                    }
                    return view('courses.master',compact('course','subject','subject_data'));
                }
            }
            else//meaning the subject is not in array of subjects
                return view('courses.master')->with('course',$course)->with('subject','');
        }

        return view('dzb');
    }//end index 
}
                            
                    /*$subjects = array('html', 'css', 'javascript', 'jquery', 'bootstrap');
                    $subjects = array('coreldraw', 'photoshop', 'gimp');                  
                    $subjects = array(,'php', 'sql', 'mysql', 'laravel');                   
                    $subjects = array(,'android-kotlin', 'android-java', 'ios-swift');                  
                    $subjects = array(,'c-sharp', 'java');                  
                    $subjects = array(,'word', 'powerpoint','excel', 'access');                 
                    $subjects = array(,'paper-work', 'machine-operations');                 
                    $subjects = array(,'online-services', 'browsers', 'miscellaneous');                 
                    $subjects = array(,'android-phones', 'iphones', 'service-providers', 'apps', 'hardware');*/