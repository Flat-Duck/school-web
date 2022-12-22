<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Chat extends Model
{
    use Searchable;

    /**
 * @var array Sets the fields that would be searched
 */
protected $searchableFields = ['*'];

    public function admin(){
        return $this->belongsTo('App\Admin');
    }


    public function user(){
        return $this->belongsTo('App\User');
    }
}
