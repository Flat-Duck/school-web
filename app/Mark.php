<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Mark extends Model
{
    use Searchable;

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
        'student_id', 'period', 'value','subject_id'
    ];

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $appends = [
        'name'
    ];


    public static function periods(){
        return [
            'الفترة الاولى',
            'الفترة الثانية'      
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
    public function getNameAttribute($key)
    {
        return $this->subject->name;
    }
}
