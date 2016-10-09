<?php 
namespace Modules\Admin\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Menu, Request, Config;
use App\Support\Menus;
use Modules\Petition\Entities\Petition;
use App\User;

class AdminController extends Controller {
	
	public function index()
	{
		

		return view('admin::index')->with('widgets', [] )->with('sidebars', []);
	}
	

}