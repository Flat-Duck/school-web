<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
        /**
     * Display a list of Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::getList();

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new Student
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.add');
    }

    /**
     * Save new Student
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validatedData = request()->validate(Student::validationRules());
        $student = Student::create($validatedData);
        return redirect()->route('admin.students.index')->with([
                'type' => 'success',
                'message' => 'Student added'
            ]);

    }

    /**
     * Show the form for editing the specified Student
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the Student
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Student $student)
    {
        $validatedData = request()->validate(
            Student::abc($student->id)
        );

        $student->update($validatedData);

        return redirect()->route('admin.students.index')->with([
            'type' => 'success',
            'message' => 'Student Updated'
        ]);
    }

    /**
     * Delete the Student
     *
     * @param \App\Student $student
     * @return void
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with([
            'type' => 'success',
            'message' => 'Student deleted successfully'
        ]);
    }
}
