<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Imports\GradesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with('course', 'student')
            ->latest()
            ->paginate(10);

        return view('grades.index', compact('grades'));
    }

    /**
     * Display a CSV uploader to insert multiple grades.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return view('grades.upload');
    }

    /**
     * Imports data from a CSV and bulk creates grades.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        Validator::make($request->all(), [
            'csv_document' => ['required', 'file', 'max:10240'],
        ])->validate();

        Excel::import(new GradesImport, $request->file('csv_document'));

        alert()->success('Success', 'All records were successfully imported');
        return redirect()->back()->with('success', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
