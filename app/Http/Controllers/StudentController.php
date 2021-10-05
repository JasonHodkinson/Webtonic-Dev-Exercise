<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Student::class, 'student');
    }

    /**
     * Validate the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(Request $request, Student $student = null)
    {
        return $request->validate([
            'student_number' => ['required', 'numeric', 'digits:5', Rule::unique('students')->ignore(optional($student)->id)],
            'first_name'     => ['required', 'string', 'min:2', 'max:50'],
            'surname'        => ['required', 'string', 'min:2', 'max:50'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = new Student();

        return view('students.create', compact('student'));
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

        $student = Student::create($request->only('student_number', 'first_name', 'surname'));

        if ($student) {
            alert()->success('Success', 'Student created');
            return redirect()->route('students.index');
        }

        alert()->error('Error', 'Failed to create student');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student->load('grades.course');
        
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validator($request, $student);

        $updated = $student->update($request->only('student_number', 'first_name', 'surname'));

        if ($updated) {
            alert()->success('Success', 'Student updated');
            return redirect()->route('students.index');
        }

        alert()->error('Error', 'Failed to update student');
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if ($student->delete()) {
            alert()->success('Success', 'Student deleted');
            return redirect()->route('students.index');
        }

        alert()->error('Error', 'There was an issue deleting the student');
        return redirect()->back();
    }
}
