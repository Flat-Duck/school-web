<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use SoftDeletes, Notifiable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token, $this->email, $this->name));
    }

        /**
     * Validation rules
     *
     * @return array
     **/
    public static function validationRules($id = null)
    {
        return [
            'name' => 'required|string',
           // 'n_id' => 'required|numeric',
            'username' => 'required|string|unique:admins,username,'.$id,
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'string|nullable',
        ];
    }
    /**
     * Profile update validation rules
     *
     * @return array
     **/
    public static function profileValidationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username,'.$id,
            'email' => 'required|email|unique:admins,email,'.$id,            
        ];
    }

    /**
     * Password update validation rules
     *
     * @return array
     **/
    public static function passwordValidationRules()
    {
        return [
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function toggleActivation(){
        $this->is_active = !$this->is_active;
        $this->save();
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
