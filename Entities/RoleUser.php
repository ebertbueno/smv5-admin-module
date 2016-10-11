<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Pingpong\Trusty\Role as BaseRole;

class RoleUser extends BaseRole
{
	protected $table = 'role_user';

	protected $fillable = ['role_id','user_id'];

	public function role()
    {
        return $this->belongsTo('Modules\Admin\Entities\Role', 'id', 'role_id');
    } 

}
