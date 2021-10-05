<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Imports\GradesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class GradeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Grade::class, 'grade');
    }

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
        // Need to check for authorisation because this is not a typical method in a resource controller
        auth()->user()->can('import', Grade::Class);

        return view('grades.upload');
    }

    /**
     * Imports data from a CSV and bulk creates grades.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        // Need to check for authorisation because this is not a typical method in a resource controller
        auth()->user()->can('import', Grade::Class);

        Validator::make($request->all(), [
            'csv_document' => ['required', 'file', 'max:10240'],
        ])->validate();

        try {
            Excel::import(new GradesImport, $request->file('csv_document'));
        } catch (Throwable $exception) {
            alert()->error('Error', 'There was an issue importing the data');
            return redirect()->back();
        }

        alert()->success('Success', 'All records were successfully imported');
        return redirect()->route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        if ($grade->delete()) {
            alert()->success('Success', 'Grade deleted');
            return redirect()->back();
        }

        alert()->error('Error', 'There was an issue deleting the grade');
        return redirect()->back();
    }
}
