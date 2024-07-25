<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            "name" => ["required", "string", "min:3", "max:50", 'unique:courses,name'],
            "slug" => ["required", "string", "min:3", "max:50", 'unique:courses,slug'],
            "description" => ["required", "string", "min:13", "max:255"],
            "long_description" => ["nullable", "string", "min:13", "max:5255"],
            "course_id" => ["required", "numeric", "exists:courses,id",],
        ]);
        $subject = Course::find($validated['course_id'])->subjects()->create($validated);
        return response()->json([
            "status" => "success",
            "message" => "Subject added successfully",
            "subject" => $subject,
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
            "name" => ["required", "string", "min:3", "max:50", 'unique:courses,name'],
            "slug" => ["required", "string", "min:3", "max:50", 'unique:courses,slug'],
            "description" => ["required", "string", "min:13", "max:255"],
            "long_description" => ["nullable", "string", "min:13", "max:5255"],
            "id" => ["required", "numeric", "exists:subjects,id",],
        ]);
        $subject = Subject::find($validated['id']);
        $subject->update($validated);
        return response()->json([
            "status" => "success",
            "message" => "Subject updated successfully",
            "subject" => $subject,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id' => ['required', 'string', 'exists:subjects,id',],
        ]);
        $subject = Subject::find($id);
        $subject->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Subject successfully deleted',
        ]);
    }
}
