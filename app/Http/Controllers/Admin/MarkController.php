<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Mark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $marks = Mark::all();//->groupBy('subject_id');
        // $marks = Mark::all(function($query){
        //     $query->groupBy('subject_id');
        // });//->paginate(1000);
     //   dd($marks);
        return view('admin.marks.index', compact('students'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::findOrFail(request()->student_id);
        $periods = Mark::periods();
        $students = Student::all();
        $subjects = Subject::all();
        $grades = Grade::all();
        return view('admin.marks.add',compact('grades','students','subjects', 'student','periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store_mark(Request $request)
    { $subs = [1,2,3,4,5,6,7,8,9,10,11];
        $student = Student::findOrFail($request->student_id);
        $data = $request->only($subs);
        
        foreach ($data as $key => $value) {
            if($request[$key] != null) {
                $mark = Mark::firstOrCreate(
                    ['student_id'=> $student->id,
                    'subject_id'=> $key,
                    'period'=> $request->period]);   
                $mark->value = $value;
                $mark->save();
            }
        }
        return redirect()->route('admin.marks.index')->with([
            'type' => 'success',
            'message' => 'تمت الاضافة بنجاح'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
