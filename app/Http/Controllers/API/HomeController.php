<?php

namespace App\Http\Controllers\API;

use App\Student;
use Illuminate\Http\Request;
use App\Chat;

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

    public function marks(Student $student)
    {
        $marks = $student->marks->groupby('subject_id');
        $mix = [];        
        foreach($marks as $mark){
            $mark = new MarkRep($mark[0]->name,$mark[0]->value,$mark[1]->value?? 0);
            array_push($mix,$mark);
        }
        
        return $this->sendResponse("marks Loaded", $mix);
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

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chats(Request $request)
    {
        $chats =  $request->user()->chats;

        foreach ($chats as $k => $chat) {
            if ($chat->sender_id != $request->user()->id) {
                $chat['ismine'] = false;
            }else{
                $chat['ismine'] = true;
            }
            $chat['date'] = $chat->created_at->diffForHumans();
            $chats[$k] = $chat;
        }
        return $this->sendResponse("User Chat Loaded Succefully", ['chats' => $chats]);
        
    }

    public function send_chat(Request $request)
    {
       // dd($request->all());
        $chat = new Chat;

        $chat->user_id = $request->user()->id;
        $chat->sender_id = $request->user()->id;
        $chat->admin_id = $request->admin_id;
        $chat->message = $request->message;        
        $chat->save();
        $chat['date'] = $chat->created_at->diffForHumans();
        $chat['ismine'] = true;
        return $this->sendResponse("User Chat Loaded Succefully", ['chat' => $chat]);

        
    }


}
class MarkRep {

    public $name;
    public $val_one;
    public $val_two;
  
    function __construct($name,$val_one,$val_two = 0) {
      $this->name = $name;
      $this->val_one = $val_one;
      $this->val_two = $val_two;
    }

    function js() {
        return [
            "subject"=>$this->name,
            "val_one"=>$this->val_one,
            "val_two"=>$this->val_two,
        ];

    }
        
}
