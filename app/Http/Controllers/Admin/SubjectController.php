<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $subjects = Subject::getList();

    return view('admin.subjects.index', compact('subjects'));
}

/**
 * Show the form for creating a new Subject
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $grades = Grade::all();

    return view('admin.subjects.add',compact('grades'));
}

/**
 * Save new Subject
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
  //  dd(request()->all());
    $validatedData = request()->validate(Subject::validationRules());
    $subject = Subject::create($validatedData);
    $subject->grades()->attach(request()->grade_id);
    return redirect()->route('admin.subjects.index')->with([
            'type' => 'success',
            'message' => 'Subject added'
        ]);

}

/**
 * Show the form for editing the specified Subject
 *
 * @param \App\Subject $subject
 * @return \Illuminate\Http\Response
 */
public function edit(Subject $subject)
{
    //dd($subject->grades->pluck('id')->flatten()->toArray());
    $grades = Grade::all();
    return view('admin.subjects.edit', compact('subject','grades'));
}

/**
 * Update the Subject
 *
 * @param \App\Subject $subject
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Subject $subject)
{
    $validatedData = request()->validate(
        Subject::validationRules($subject->id)
    );

    $subject->update($validatedData);
    $subject->grades()->sync(request()->grade_id);

    return redirect()->route('admin.subjects.index')->with([
        'type' => 'success',
        'message' => 'Subject Updated'
    ]);
}

/**
 * Delete the Subject
 *
 * @param \App\Subject $subject
 * @return void
 */
public function destroy(Subject $subject)
{
    $subject->delete();
    return redirect()->route('admin.subjects.index')->with([
        'type' => 'success',
        'message' => 'Subject deleted successfully'
    ]);
}
}
