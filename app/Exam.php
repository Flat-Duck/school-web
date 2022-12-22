<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Exam extends Model
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
        'date', 'grade_id', 'room_id','subject_id'
    ];



    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'date' => 'required',
            'room_id' => 'required',
            'grade_id' => 'required',
            'subject_id' => 'required',
        ];
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
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
