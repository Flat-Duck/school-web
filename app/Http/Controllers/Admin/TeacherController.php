<?php

namespace App\Http\Controllers\Admin;

use App\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $teachers = Teacher::getList();

    return view('admin.teachers.index', compact('teachers'));
}

/**
 * Show the form for creating a new Teacher
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('admin.teachers.add');
}

/**
 * Save new Teacher
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate(Teacher::validationRules());
    $teacher = Teacher::create($validatedData);
    return redirect()->route('admin.teachers.index')->with([
            'type' => 'success',
            'message' => 'Teacher added'
        ]);

}

/**
 * Show the form for editing the specified Teacher
 *
 * @param \App\Teacher $teacher
 * @return \Illuminate\Http\Response
 */
public function edit(Teacher $teacher)
{
    return view('admin.teachers.edit', compact('teacher'));
}

/**
 * Update the Teacher
 *
 * @param \App\Teacher $teacher
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Teacher $teacher)
{
    $validatedData = request()->validate(
        Teacher::validationRules($teacher->id)
    );

    $teacher->update($validatedData);

    return redirect()->route('admin.teachers.index')->with([
        'type' => 'success',
        'message' => 'Teacher Updated'
    ]);
}

/**
 * Delete the Teacher
 *
 * @param \App\Teacher $teacher
 * @return void
 */
public function destroy(Teacher $teacher)
{
    $teacher->delete();
    return redirect()->route('admin.teachers.index')->with([
        'type' => 'success',
        'message' => 'Teacher deleted successfully'
    ]);
}
}
