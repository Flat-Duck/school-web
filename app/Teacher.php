<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\Searchable;
class Teacher extends Model
{
    use SoftDeletes, Searchable;

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
            'name'=> 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'gender'=> 'required|string',
            'department'=> 'required|string',
            'email'=> 'required|string',
            'phone'=> 'required|numeric',
            'n_id'=>'required|numeric|unique:teachers,n_id,'.$id,

            // 'is_active' => 'boolean',
        ];
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
