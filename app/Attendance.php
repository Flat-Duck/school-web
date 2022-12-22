<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\Searchable;
class Attendance extends Model
{
    use Searchable;

    /**
 * @var array Sets the fields that would be searched
 */
protected $searchableFields = ['*'];
   // use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day','student_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        //'day' => 'date',
    ];


    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'day' => 'required|date',
            'student_id' => 'required|numeric',
        ];
    }

    public function student()
    {
        return $this->belongsTo(\App\Student::class);
    }

     /**
     * Returns the paginated list of resources
     *
     * @return \Illuminate\Pagination\Paginator
     **/
    public static function getList($search = null)
    {
        return static::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();
        
    }

}
