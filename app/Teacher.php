<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'department',
        'email',
        'phone',
        'is_active',
    ];



    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'name'=> 'required|string',
            'gender'=> 'required|string',
            'department'=> 'required|string',
            'email'=> 'required|string',
            'phone'=> 'required|string',
            // 'is_active' => 'boolean',
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
