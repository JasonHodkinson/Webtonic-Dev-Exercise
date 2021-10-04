<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;

class DashboardController extends Controller
{
    /**
     * Display all the grades on the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = [
            'courses' => Course::count(),
            'students' => Student::count(),
            'grades' => Grade::count()
        ];

        return view('dashboard', compact('entries'));
    }
}
