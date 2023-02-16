<?php

namespace App;

use Illuminate\Validation\Rule;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Room extends Model
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
        'name','grade_id'
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
            'grade_id' => 'required|numeric',
        ];
    }

    public function students()
    {
        return $this->hasMany(\App\Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(\App\Grade::class);
    }
    
    public function subjects()
    {
        return $this->grade->subjects;
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function timeTable()
    {
        return $this->hasMany(TimeTable::class);
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
}
