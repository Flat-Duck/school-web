<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'content',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'content' => 'required|string',
             'student_id' => 'numeric',
        ];
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
