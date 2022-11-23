<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

}
