<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use App\Scopes\Searchable;
class Student extends Model
{
    use SoftDeletes, Searchable,CascadeSoftDeletes;

    /**
 * @var array Sets the fields that would be searched
 */
protected $searchableFields = ['*'];
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
        'room_id',
        'n_id',
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
        // 'birth_date' => 'date',
    ];

    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'phone'=> 'required|numeric',
            'room_id' => 'required',
            'email' => 'required|email',
            'n_id'=>'required|numeric|unique:students,n_id,'.$id,
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

    public function marks(){
        return $this->hasMany(Mark::class);
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
    public function marksGruoped(){
        return $this->marks->groupBy('subject_id');
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
    public static function getList($search = null)
    {
        return static::search($search)
        ->orderBy('created_at', 'ASC')
        ->paginate(10)
        ->withQueryString();
        
    }
    public static function boot() {
      parent::boot();
    
      static::deleting(function($student) { // before delete() method call this
           $student->attendances()->delete();
           $student->notes()->delete();
           // do the rest of the cleanup...
      });
    }
}
