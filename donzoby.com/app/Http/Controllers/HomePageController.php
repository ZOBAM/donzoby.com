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
use Illuminate\Support\Facades\Log;

class HomePageController extends Controller
{
	public function index($course = 1, $subject = 2, $id = 0, $slug = null) //{course}/{subject?}/{id?}/{topic?}
	{
		//get only parent posts
		$posts = Post::where('parent_id', null)->where('status', 'published')->orderBy('created_at', 'desc')->take(22)->get();

		$listed_subjects = [];
		foreach ($posts as $value) { //get array of fetched post's subjects
			$listed_subjects[] = $value->subject->name;
		}
		$listed_subjects = array_unique($listed_subjects); //return unique subjects in the array

		// fetch latest post for each of the courses of interest
		$latest = $this->get_latest(['front-end', 'back-end', 'graphics']);
		$latest_modified = $this->get_latest(['front-end', 'graphics', 'back-end'], true);

		$course = strtolower($course);
		$subject = strtolower($subject);
		$page_image = URL('images/donzoby-logo-wtbg.png');


		if (Course::where('slug', $course)->first()) { // check if course in url exists

			if (file_exists('images/dzb-' . $course . '.png')) {
				$page_image = URL('images/dzb-' . $course . '.png');
			}

			if (Subject::where('slug', $subject)->first()) {
				if ($id || $slug) { // an id is provided
					// format slug for old links from outside
					$slug = is_numeric($id) && $id != 0 ? $slug : $id;
					$slug = str_replace(' ', '_', str_replace('-', '_', strtolower($slug)));

					$post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
					$post->timestamps = false; //prevent updating of time stamps
					//check ip address of my computer & email of logged in user and only add counts if visit is not from the developer
					//adding this email aspect will make it possible for me to login from any other device and hits won't be incremented
					$developer_email = (isset(Auth::user()->email)) ? Auth::user()->email : false;
					if ($_SERVER['REMOTE_ADDR'] != "197.211.61.117" && $_SERVER['REMOTE_ADDR'] != "102.89.1.21" && $_SERVER['REMOTE_ADDR'] != "197.211.61.133" && $_SERVER['REMOTE_ADDR'] != "141.0.13.181" && $developer_email != "upc4you@gmail.com") {
						$post->hits = ++$post->hits;
						$post->save();
					}
					if (Post_image::where('post_id', $id)->first()) {
						$page_image = Post_image::where('post_id', $id)->first(); //get image for FB share
						$page_image = URL($page_image->link);
					}
					$description = $post->description; //meta description
					$title = $post->topic; //page title
					//get comments
					$comments = Comment::where('post_id', $id)->with('user')->get();

					return view('single', compact('post', 'subject', 'comments', 'posts', 'listed_subjects', 'description', 'title', 'page_image'));
				} //end id not 0 or data-plans
				else { //invalid id provided, just list topics under the specified subject
					$subject = Subject::where('slug', $subject)->first();
					$description = $subject->description; //meta description
					$title = $subject->name; //page title

					return view('subject', compact('course', 'subject', 'posts', 'listed_subjects', 'description', 'title', 'page_image'));
				}
			} else { //meaning the subject is not in array of subjects
				$subject = '';
				$course = Course::where('slug', $course)->first();
				$description = $course->description;
				$title = $course->name; //page title
				return view('course', compact('course', 'subject', 'posts', 'listed_subjects', 'description', 'title', 'page_image'));
			}
		} else { //meaning the course is not in array of courses, return to home page
			$description = "Donzoby offers well written and easy to follow tutorials on computer and web technologies for the Elects. We also offer ICT and computer literacy training services. We do tech with conscience.";
			$title = "Tech Tutorials for The Elects";
			// dd($latest['front-end']->subject->course->subjects);
			return view('dzb', compact('posts', 'listed_subjects', 'latest', 'latest_modified', 'description', 'title', 'page_image'));
		}
	} //end index
	private function get_latest(array $courses_slugs, $modified = false)
	{
		$latest = [];
		foreach ($courses_slugs as $course_slug) {
			if ($modified) {
				$latest[$course_slug] = Post::where('status', 'published')->whereHas('subject', function ($query) use ($course_slug) {
					$query->whereHas('course', function ($query) use ($course_slug) {
						$query->where('slug', $course_slug);
					});
				})->orderBy('updated_at', 'desc')->first();
			} else {
				$latest[$course_slug] = Post::where('status', 'published')->whereHas('subject', function ($query) use ($course_slug) {
					$query->whereHas('course', function ($query) use ($course_slug) {
						$query->where('slug', $course_slug);
					});
				})->orderBy('created_at', 'desc')->take(5)->get();
			}
		}
		return $latest;
	}
}
