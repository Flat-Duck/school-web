<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Student;
use App\Http\Controllers\Controller;
use App\Room;
use App\User;
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
        $grades = Grade::all();
        $rooms = Room::all();

        return view('admin.students.add',compact('grades','rooms'));
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
        $user = User::where('email',$student->email)->first();
        if(is_null($user)){
            $user = User::firstOrCreate(
                ['name'=> substr(strstr($student->name," "), 1),
                'email'=> request()->email,
                'password'=> bcrypt($student->phone)]
            );
        }
        
        //dd($user);
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
        $grades = Grade::all();
        $rooms = Room::all();
      //  dd($student);
        return view('admin.students.edit', compact('student','grades','rooms'));
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
            Student::ValidationRules($student->id)
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
