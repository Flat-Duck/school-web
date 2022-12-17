<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class PromoteController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $students = Student::all();
    $error = [];
    $error['has_missing_subjects'] = [];
    $error['has_missing_periods'] = [];
    $error['failed_in_subjects'] = [];
    foreach($students as $k =>$student){
        $totSubjects = $student->marks->groupby('subject_id');        
        if($totSubjects->count() < $student->grade->subjects->count()){
            array_push($error['has_missing_subjects'],$student);
        }else{            
            foreach($totSubjects as $k => $subject){                
                $num = $subject->sum('value');
                if($subject->count() < 2){
                    array_push($error['has_missing_periods'],$student);                    
                }else{
                    $marks[$subject[0]->subject_id] = $num;
                }                            
            }
            foreach($marks as $k => $mark){
                if($mark < 50 ){
                    array_push($error['failed_in_subjects'],$student);                    
                }                
            }
        }
        
        if(!in_array($student, $error['has_missing_subjects'])) {
            if(!in_array($student, $error['has_missing_periods'])) {
                if(!in_array($student, $error['failed_in_subjects'])) {
                    $this->promoteStudent($student);                    
                }
            }           
        }
    }  
    
    $error['has_missing_subjects'] = array_unique($error['has_missing_subjects']);
    $error['has_missing_periods'] = array_unique($error['has_missing_periods']);
    $error['failed_in_subjects'] = array_unique($error['failed_in_subjects']);
    
}

/**
 * Show the form for creating a new Note
 *
 * @return \Illuminate\Http\Response
 */
public function promote()
{
    $students = Student::all();
    $error = [];
    $error['has_missing_subjects'] = [];
    $error['has_missing_periods'] = [];
    $error['failed_in_subjects'] = [];
    foreach($students as $k =>$student){
        $totSubjects = $student->marks->groupby('subject_id');        
        if($totSubjects->count() < $student->grade->subjects->count()){
            array_push($error['has_missing_subjects'],$student);
        }else{            
            foreach($totSubjects as $k => $subject){                
                $num = $subject->sum('value');
                if($subject->count() < 2){
                    array_push($error['has_missing_periods'],$student);                    
                }else{
                    $marks[$subject[0]->subject_id] = $num;
                }                            
            }
            foreach($marks as $k => $mark){
                if($mark < 50 ){
                    array_push($error['failed_in_subjects'],$student);                    
                }                
            }
        }           
    }  
    
    $error['has_missing_subjects'] = array_unique($error['has_missing_subjects']);
    $error['has_missing_periods'] = array_unique($error['has_missing_periods']);
    $error['failed_in_subjects'] = array_unique($error['failed_in_subjects']);
    
    return view('admin.promote.index',compact('error'));
}

public function promoteStudent(Student $student){
    if($student->grade->id == 6){
        $student->delete();
    }else{
        $student->room_id += 10;
        $student->save();
    }
}

/**
 * Save new Note
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate(Note::validationRules());
    $note = Note::create($validatedData);
    return redirect()->route('admin.notes.index')->with([
            'type' => 'success',
            'message' => 'تمت الاضافة بنجاح'
        ]);

}

/**
 * Show the form for editing the specified Note
 *
 * @param \App\Note $note
 * @return \Illuminate\Http\Response
 */
public function edit(Note $note)
{
    $students = Student::all();
    return view('admin.notes.edit', compact('note','students'));
}

/**
 * Update the Note
 *
 * @param \App\Note $note
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Note $note)
{
    $validatedData = request()->validate(
        Note::validationRules($note->id)
    );

    $note->update($validatedData);

    return redirect()->route('admin.notes.index')->with([
        'type' => 'success',
        'message' => 'تم التعديل بنجاج'
    ]);
}

/**
 * Delete the Note
 *
 * @param \App\Note $note
 * @return void
 */
public function destroy(Note $note)
{
    $note->delete();
    return redirect()->route('admin.notes.index')->with([
        'type' => 'success',
        'message' => 'تم الحذف بنجاح'
    ]);
}
}
