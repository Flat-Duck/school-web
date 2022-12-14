<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $grades = Grade::getList();

    return view('admin.grades.index', compact('grades'));
}

/**
 * Show the form for creating a new Grade
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('admin.grades.add');
}

/**
 * Save new Grade
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate(Grade::validationRules());
    $grade = Grade::create($validatedData);
    return redirect()->route('admin.grades.index')->with([
            'type' => 'success',
            'message' => 'تمت الاضافة بنجاح'
        ]);

}

/**
 * Show the form for editing the specified Grade
 *
 * @param \App\Grade $grade
 * @return \Illuminate\Http\Response
 */
public function edit(Grade $grade)
{
    return view('admin.grades.edit', compact('grade'));
}

/**
 * Update the Grade
 *
 * @param \App\Grade $grade
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Grade $grade)
{
    $validatedData = request()->validate(
        Grade::validationRules($grade->id)
    );

    $grade->update($validatedData);

    return redirect()->route('admin.grades.index')->with([
        'type' => 'success',
        'message' => 'تم التعديل بنجاج'
    ]);
}

/**
 * Delete the Grade
 *
 * @param \App\Grade $grade
 * @return void
 */
public function destroy(Grade $grade)
{
    $grade->delete();
    return redirect()->route('admin.grades.index')->with([
        'type' => 'success',
        'message' => 'تم الحذف بنجاح'
    ]);
}
}
