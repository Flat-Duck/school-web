<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $attendances = Attendance::getList();

    return view('admin.attendances.index', compact('attendances'));
}

/**
 * Show the form for creating a new Attendance
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $students = Student::all();
    return view('admin.attendances.add', compact('students'));
}

/**
 * Save new Attendance
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate(Attendance::validationRules());
    $attendance = Attendance::create($validatedData);
    return redirect()->route('admin.attendances.index')->with([
            'type' => 'success',
            'message' => 'Attendance added'
        ]);

}

/**
 * Show the form for editing the specified Attendance
 *
 * @param \App\Attendance $attendance
 * @return \Illuminate\Http\Response
 */
public function edit(Attendance $attendance)
{
    $students = Student::all();
    return view('admin.attendances.edit', compact('attendance','students'));
}

/**
 * Update the Attendance
 *
 * @param \App\Attendance $attendance
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Attendance $attendance)
{
    $validatedData = request()->validate(
        Attendance::validationRules($attendance->id)
    );

    $attendance->update($validatedData);

    return redirect()->route('admin.attendances.index')->with([
        'type' => 'success',
        'message' => 'Attendance Updated'
    ]);
}

/**
 * Delete the Attendance
 *
 * @param \App\Attendance $attendance
 * @return void
 */
public function destroy(Attendance $attendance)
{
    $attendance->delete();
    return redirect()->route('admin.attendances.index')->with([
        'type' => 'success',
        'message' => 'Attendance deleted successfully'
    ]);
}
}
