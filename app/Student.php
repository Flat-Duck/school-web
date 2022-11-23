<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'email',
        'phone',
       // 'is_active',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $appends = [
        'room_name',
        'grade_name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birth_date' => 'timestamp',
    ];

    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
           // 'is_active'  => 'boolean',
        ];
    }
     
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
    
    
    public function parent(){
        return $this->belongsTo(User::class,'email','email');
    }
    
    public function timeTable(){
        return $this->room->timeTable();
    }

    public function grade(){
        return $this->room->grade();
    }
    
    public function exams(){
        return $this->room->exams();
    }

    public function subjects(){
        return $this->grade->subjects();
    }

    public function getRoomNameAttribute(){
        return $this->room->name;
    }
    
    public function getGradeNameAttribute(){
        return $this->room->grade->name;
    }

    /**
     * Returns the paginated list of resources
     *
     * @return \Illuminate\Pagination\Paginator
     **/
    public static function getList()
    {
        return static::paginate(10);
    }
}
