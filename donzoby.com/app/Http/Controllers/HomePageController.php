<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Post;
use App\Models\Post_image;
use App\Models\Profile_picture;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
	public function index($course = 1, $subject = 2, $id = 0, $topic = "2") //{course}/{subject?}/{id?}/{topic?}
	{
		//get only parent posts
		$posts = Post::where('parent_id', null)->orderBy('created_at', 'desc')->take(22)->get();

		$listed_subjects = [];
		foreach ($posts as $value) { //get array of fetched post's subjects
			$listed_subjects[] = $value->subject->name;
		}
		$listed_subjects = array_unique($listed_subjects); //return unique subjects in the array

		// fetch latest post for each of the courses of interest
		$latest['front-end'] = Post::whereHas('subject', function ($query) {
			$query->whereHas('course', function ($query) {
				$query->where('slug', 'front-end');
			});
		})->first();
		$latest['graphics'] = Post::whereHas('subject', function ($query) {
			$query->whereHas('course', function ($query) {
				$query->where('slug', 'graphics');
			});
		})->first();
		$latest['back-end'] = Post::whereHas('subject', function ($query) {
			$query->whereHas('course', function ($query) {
				$query->where('slug', 'back-end');
			});
		})->first();

		$course = strtolower($course);
		$subject = strtolower($subject);
		$page_image = URL('images/donzoby-logo-wtbg.png');


		if (Course::where('slug', $course)->first()) { // check if course in url exists

			if (file_exists('images/dzb-' . $course . '.png')) {
				$page_image = URL('images/dzb-' . $course . '.png');
			}

			if (Subject::where('slug', $subject)->first()) {
				if ($id != 0 && is_numeric($id)) { // an id is provided
					$topic = Post::findOrFail($id);
					$topic->timestamps = false; //prevent updating of time stamps
					//check ip address of my computer & email of logged in user and only add counts if visit is not from the developer
					//adding this email aspect will make it possible for me to login from any other device and hits won't be incremented
					$developer_email = (isset(Auth::user()->email)) ? Auth::user()->email : false;
					if ($_SERVER['REMOTE_ADDR'] != "197.211.61.117" && $_SERVER['REMOTE_ADDR'] != "102.89.1.21" && $_SERVER['REMOTE_ADDR'] != "197.211.61.133" && $_SERVER['REMOTE_ADDR'] != "141.0.13.181" && $developer_email != "upc4you@gmail.com") {
						$topic->hits = ++$topic->hits;
						$topic->save();
					}
					if (Post_image::where('post_id', $id)->first()) {
						$page_image = Post_image::where('post_id', $id)->first(); //get image for FB share
						$page_image = URL($page_image->link);
					}
					$description = $topic->description; //meta description
					$title = $topic->topic; //page title
					//get comments
					$comments = Comment::where('post_id', $id)->get();
					if (count($comments) > 0) {
						$i = 0;
						foreach ($comments as $comment) {
							$comment_authors = User::where('id', $comment->user_id)->first();
							$comments[$i]->author_name = $comment_authors->name;
							$author_image = Profile_picture::where('user_id', $comment_authors->id)->first();
							if ($author_image) {
								$comments[$i]->author_image_link = URL($author_image->link);
							} else {
								$comments[$i]->author_image_link = URL('images/donzoby-logo-wtbg.png');
							}
							$i++;
						} //endforeach
					} //endif
					return view('single', compact('topic', 'subject', 'posts', 'listed_subjects', 'comments', 'description', 'title', 'page_image'));
				} //end id not 0 or data-plans
				else { //invalid id provided, just list topics under the specified subject
					$subject_model = Subject::where('slug', $subject)->first();
					$description = $subject_model->description; //meta description
					$title = $subject_model->name; //page title
					$subject_data = Post::where('subject_id', $subject_model->id)->get();
					if (count($subject_data) == 0) {
						$subject_data = false;
					}
					return view('subject', compact('course', 'subject', 'subject_data', 'posts', 'listed_subjects', 'description', 'title', 'page_image'));
				}
			} else { //meaning the subject is not in array of subjects
				$subject = '';
				$course_model = Course::where('slug', $course)->first();
				$description = $course_model->description;
				$title = $course_model->name; //page title
				return view('course', compact('course', 'subject', 'posts', 'listed_subjects', 'description', 'title', 'page_image'));
			}
		} else { //meaning the course is not in array of courses, return to home page
			$description = "Donzoby offers well written and easy to follow tutorials on computer and web technologies for the Elects. We also offer ICT and computer literacy training services. We do tech with conscience.";
			$title = "Tech Tutorials for The Elects";
			return view('dzb', compact('posts', 'listed_subjects', 'latest', 'description', 'title', 'page_image'));
		}
	} //end index
}
