<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('name', '!=', null)->with('subjects')->get();
        return view("user.course")->with(["courses"=> $courses]);
        /* return [
            "status"=> 'success',
            "courses"=> Course::all()->with("subjects"),
        ]; */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=> ["required","string","min:3", "max:50", 'unique:courses,name'],
            "slug"=> ["required","string","min:3","max:50", 'unique:courses,slug'],
            "description"=> ["required","string","min:13","max:255"],
        ]);
        $course = Course::create($validated);
        $course->subjects = [];
        return response()->json([
            "status"=> "success",
            "message"=> "Course added successfully",
            "course"=> $course,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "name"=> ["required","string","min:3", "max:50"],
            "slug"=> ["required","string","min:3","max:50"],
            "description"=> ["required","string","min:13","max:255"],
            'id'=>['required','numeric','exists:courses,id',],
        ]);
        $course = Course::find($id);
        $course->update($validated);
        $course = Course::where('id', $id)->with('subjects')->first();
        return response()->json([
            'status'=> 'success',
            'message'=> 'Course successfully updated',
            'course'=> $course,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $request->merge(['id'=> $id]);
        $validated = $request->validate([
            'id'=> ['required','string','exists:courses,id',],
        ]);
        $course = Course::find($id);
        $course->delete();
        return response()->json([
            'status'=> 'success',
            'message'=> 'Course successfully deleted',
        ]);
    }
}
