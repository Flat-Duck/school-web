<?php

namespace App\Http\Controllers\API;

use App\Student;

class HomeController extends ApiController
{
    public function notes(Student $student)
    {
        $notes = $student->notes;

        return $this->sendResponse("Notes Loaded", $notes);
    }

    public function attendances(Student $student)
    {
        $attendances = $student->attendances;

        return $this->sendResponse("Attendances Loaded", $attendances);
    }

    public function subjects(Student $student)
    {
        $subjects = $student->subjects;

        return $this->sendResponse("Subjects Loaded", $subjects);
    }

    public function exams(Student $student)
    {
        $exams = $student->exams;
        
        $exams = $exams->each(function ($item, $key) {
          $item['subject_name'] = $item->subject->name;
        });

        return $this->sendResponse("Exams Loaded", $exams);
    }

    public function time_tables(Student $student)
    {
        $time_tables = $student->timeTable;

        return $this->sendResponse("Time Tables Loaded", $time_tables);
    }
    public function profile()
    {
        $user = request()->user();

        return $this->sendResponse("Profile Loaded", $user);
    }
    public function student(Student $student)
    {        

        return $this->sendResponse("Profile Loaded", $student);
    }

    public function main()
    {
        $student  = request()->user()->students;        
        return $this->sendResponse("Students Loaded", $student);
    }
    public function updatePassword()
    {
        $user = request()->user();
         //return $this->sendResponse("password Changed Successful", $user);
        $user->password = bcrypt('123456');
        $user->save();

        return $this->sendResponse("password Changed Successful", $user);
    }
}
