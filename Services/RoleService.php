<?php

namespace Modules\Admin\Services;

use Auth;
use Modules\Admin\Repositories\Roles\RoleRepository;

class RoleService{
	
	private $Roles;
	
	public function __construct( RoleRepository $RoleRepository){
		$this->Roles = $RoleRepository;
	}

}