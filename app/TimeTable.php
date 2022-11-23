<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $appends = ['details'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day', 'period','subject_id','room_id' 
    ];

    public static function days(){
        return [
            'الأحد',
            'الأثنين',
            'الثلاثاء',
            'الإربعاء',
            'الخميس'
        ];
    }

    public static function periods(){
        return [
            'الاولى',
            'الثانية',
            'الثالثة',
            'الرابعة',
            'الخامسة',
            'السادسة',
            'السابعة'
        ];
    }

    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function ValidationRules($id = null)
    {
        return [
            'room_id' => 'required'
        ];
    }
    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function PeriodValidationRules($id = null)
    {
        return [
            'day' => 'required|string|max:10',
            'period' => 'required',
            'subject_id' => 'required',
        ];
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function grade()
    {
        return $this->room->grade();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot(['day','period']);
    }

   public function getDetailsAttribute(){
    $details = [];
       $subjects = $this->subjects()->get();
       foreach ($subjects as $sub) {
        $day = $sub->pivot->day;
        $period = $sub->pivot->period;
        $details[$day][$period]['subject'] = $sub->name;
       }       
        return $details;
     return $this;
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
