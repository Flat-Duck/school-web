<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'period', 'value','subject_id'
    ];


    public static function periods(){
        return [
            'الفترة الاولى',
            'الفترة الثانية',
            'الفترة الثالثة'            
        ];
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);//->with(['value','period']);
    }
}
