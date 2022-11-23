<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Grade extends Model
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
     * Get all of the studentss for the Grade
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(Student::class, Room::class);
    }
    
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
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
