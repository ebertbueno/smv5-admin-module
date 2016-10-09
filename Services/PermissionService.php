<?php

namespace Modules\Admin\Services;

use Auth;
use Modules\Admin\Repositories\Permissions\PermissionRepository;

class PermissionService{
	
	private $Permission;
	
	public function __construct( PermissionRepository $Repository){
		$this->Permission = $Repository;
	}

}