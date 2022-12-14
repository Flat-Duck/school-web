<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Room;
use App\Grade;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class AjaxController extends ApiController
{
    public function exam(Request $request)
    {
        $grade_id = $request->grade_id;
        $grade = Grade::find($grade_id);

        $data['rooms'] = $grade->rooms;
        $data['subjects'] = $grade->subjects;

        return $this->sendResponse("Data Loaded", $data);    
    }
    public function students(Request $request)
    {
        $grade_id = $request->grade_id;
        $grade = Grade::findOrFail($grade_id);
        
        $data['students'] = $grade->students;

        return $this->sendResponse("Data Loaded", $data);    
    }
    public function marks(Request $request)
    {
        $student_id = $request->student_id;
        $student = Student::findOrFail($student_id);
        
        $data['subjects'] = $student->subjects;

        return $this->sendResponse("Data Loaded", $data);    
    }
    public function time_table(Request $request)
    {
        $grade_id = $request->grade_id;
        $grade = Grade::find($grade_id);
        
        $data['rooms'] = $grade->rooms;
        $data['subjects'] = $grade->subjects;

        return $this->sendResponse("Data Loaded", $data);    
    }

    public function swipes()
    {
        $swipes = request()->user()->swipes;

        return $this->sendResponse("Data Loaded", $swipes);
    }
    public function shots()
    {
        $shots = request()->user()->shots;

        return $this->sendResponse("Data Loaded", $shots);
    }

    // public function centers()
    // {
    //     $centers = Center::all();
    //     return $this->sendResponse("Data Loaded", $centers);
    // }
    public function profile()
    {
        $user = request()->user();

        return $this->sendResponse("Profile Loaded", $user);
    }

    
    public function updatePassword()
    {
        $user = request()->user();
         return $this->sendResponse("password Changed Successful", $user);
        $user->password = bcrypt(request()->password);
        $user->save();

        return $this->sendResponse("password Changed Successful", $user);
    }
}
