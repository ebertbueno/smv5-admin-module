<?php

namespace Modules\Admin\Services;

use Auth;
use Modules\Admin\Repositories\User\UserRepository;

class UserService{
	
	private $User;
	
	public function __construct( UserRepository $UserRepository){
		$this->User = $UserRepository;
	}

}