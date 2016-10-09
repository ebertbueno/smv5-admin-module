<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module;
use Redirect;

class ModulesController extends Controller
{

    public function __construct()
    {
        $this->middleware("roles:admin");
        $this->middleware("permissions:manage-modules");
    }
    /**
     * Display a listing of categories.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $enabled = Module::enabled();
        $disabled = Module::disabled();

        return View('admin::modules.index', compact('enabled', 'disabled'));
    }

    public function enable( $name )
    {
        if( Module::has( $name ) )
        {
            $module = Module::find( $name );
            $module->enable();

            return Redirect::route('admin.modules.index')
                ->with('message', $name.' Enable successful!');
        }

        return Redirect::route('admin.modules.index')
            ->with('message', 'The module '.$name.' does exists! ');
    }

    public function disable( $name )
    {
       if( Module::has( $name ) )
        {
            $module = Module::find( $name );
            $module->disable();

            return Redirect::route('admin.modules.index');
        }

        return Redirect::route('admin.modules.index')
            ->with('message', 'The module '.$name.' does exists! ')
                ->with('message', $name.' Disable successful!');
    }

}
