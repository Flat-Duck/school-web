<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Teacher extends Model
{
    use SoftDeletes;
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
        'n_id',
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
            'n_id'=>'required|numeric|unique:teachers,n_id',

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
