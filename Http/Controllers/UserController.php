<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Account;
use Modules\Admin\Repositories\User\UserRepository;
use Auth, Validator, Input, Hash;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    protected $user, $levels, $langs;

    public function __construct(UserRepository $user)
    {
        $this->middleware('roles:admin', ['except'=>['update','edit']]);
        $this->middleware('permissions:manage-users', ['except'=>['update','edit']]);

        $this->user = $user;
		$this->levels = [1=>'Admin', 2=>'Visitor'];
		$this->langs = ['en'=>'English', 'pt'=>'Português'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
				$levels = $this->levels;
				$langs = $this->langs;
			
        if ($request->ajax())
        {
            $users = $this->user->all(['id','name','last_name','email','level','language','status']);

             return Datatables::of( $users )
							  ->editColumn('level', function($user) use ($levels){
										return  $levels[ $user->level ];
								})
							 	->editColumn('language', function($user) use ($langs){
										return  $langs[$user->language];
								})
							 	->editColumn('status', function($user){
										return  ( $user->status == 1 ? trans('admin::layout.active'):trans('admin::layout.deactive') );
								})
                ->addColumn('action', function ($user) {
                    return '<button class="btn btn-link" ng-click="toggle(\'edit\', '.$user->id.')">Edit</button>
                            <button class="btn btn-link" ng-click="toggle(\'delete\', '.$user->id.')" > Delete</button>';
                })
                ->make();
        }
        return View('admin::user.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $all = $request->all();

        $valid = Validator::make( $all, [     
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
	 			]);

        if( $valid->passes() )
        {
						$all['password'] = Hash::make($all['password']);
            $this->user->create($all);

            return response()->json(['message' => trans('admin::layout.alert_success')], 200);
        }

        if ( $request->ajax() )
            return response()->json( ['message'=>trans('admin::layout.alert_error'),'error'=>$valid->getMessageBag()->toArray()], 412 );

        return redirect()->route('admin.users.index')->withMessage(trans('admin::layout.alert_error'))->withErrors($valid);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$user = $this->user->find($id);
			
        return response()->json( $user );
    }


    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if( $request->ajax() )
        {
             $id = Auth::user()->id;
             return response()->json( $this->user->find($id, ['id', 'name', 'last_name', 'email', 'language']) );
        }
       

        return View('admin::user.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if( !Auth::user()->is('Admin') )
        {
            $id = Auth::user()->id;
        }

		$input = $request->except(['_method', '_token']);


		$validation = Validator::make($input,  [
						'name' => 'required',
                        'email' => 'required|email|max:255|unique:users,email,'.$id,
						'password' => 'confirmed'
			]);

		if( $validation->passes() )
		{
				unset( $input['password_confirmation'] );

				if( empty($input['password']) ) 
						unset($input['password']);
				else
						$input['password'] = Hash::make($input['password']);

				$this->user->update( $input, $id );

				if ($request->ajax())
						return response()->json( ['message'=>trans('admin::layout.alert_success')]);

				return redirect('admin/user/'.$id);  
		}

        if ($request->ajax())
                return response()->json( ['message'=>trans('admin::layout.alert_error'),'error'=>$validation->getMessageBag()->toArray()], 412 );

				return redirect()->route('admin.user.show', $id)
						->withInput()
						->withErrors($validation);
				
    }

		
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rs = $this->user->delete($id);
				if( $rs ){ 
					$message = trans('admin::layout.alert_success'); $cod = 200;
				}
				else{
					$message = trans('admin::layout.alert_error'); $cod = 412;
				}
			
        if ($request->ajax())
		        return response()->json(['message'=>$message ], $cod); 
    
				return redirect()->route('admin.user.index')->withMessage(['message'=>$message]);

    }
	
		
}
