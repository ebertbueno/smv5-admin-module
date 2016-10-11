<?php

namespace Modules\Admin\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Pingpong\Trusty\Traits\TrustyTrait;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract,
                                    Transformable
{
    use Authenticatable;
    use CanResetPassword;
    use \Stevebauman\EloquentTable\TableTrait;
    use SoftDeletes;
    use TransformableTrait;
    use TrustyTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'last_name', 'email', 'password', 'language', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];
                                      
   public $rules =[ 
            
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
            
	 ];
          
	 public function roles()
   {
        return $this->hasOne('Modules\Admin\Entities\RoleUser', 'user_id');
   }
                                      
}
