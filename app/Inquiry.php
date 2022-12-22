<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Inquiry extends Model
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
        'discription', 
    ];



    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'discription' => 'required|string',
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
