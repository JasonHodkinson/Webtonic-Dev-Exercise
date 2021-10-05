<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Course::class, 'course');
    }

    /**
     * Validate the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(Request $request, Course $course = null)
    {
        return $request->validate([
            'code'        => ['required', 'string', 'max:50', Rule::unique('courses')->ignore(optional($course)->id)],
            'description' => ['required', 'string', 'min:5', 'max:50'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();

        return view('courses.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);

        $course = Course::create($request->only('code', 'description'));

        if ($course) {
            alert()->success('Success', 'Course created');
            return redirect()->route('courses.index');
        }

        alert()->error('Error', 'Failed to create course');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course->load('grades.student');
        
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validator($request, $course);

        $updated = $course->update($request->only('code', 'description'));

        if ($updated) {
            alert()->success('Success', 'Course updated');
            return redirect()->route('courses.index');
        }

        alert()->error('Error', 'Failed to update course');
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if ($course->delete()) {
            alert()->success('Success', 'Course deleted');
            return redirect()->route('courses.index');
        }

        alert()->error('Error', 'There was an issue deleting the course');
        return redirect()->back();
    }
}
