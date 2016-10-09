<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Repositories\Roles\RoleRepository;
use Modules\Admin\Validation\Role\Create;
use Modules\Admin\Validation\Role\Update;
use Auth;

class RolesController extends Controller
{
    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->middleware("roles:admin");

        $this->middleware("permissions:manage-roles");

        $this->repository = $repository;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display a listing of roles.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->allOrSearch(Input::get('q'));

        $no = $roles->firstItem();

        return View('admin::roles.index', compact('roles', 'no'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Response
     */
    public function create()
    {

        return View('admin::roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $role = $this->repository->findById($id);

            return View('admin::roles.show', compact('role'));
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $role = $this->repository->findById($id);

            $permission_role = $role->permissions->lists('id');

            return View('admin::roles.edit', compact('role', 'permission_role'));
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Update the specified role in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $role = $this->repository->findById($id);

            $data = $request->all();

            $role->update($data);

            if ($role->permissions->count()) {
                $role->permissions()->detach($role->permissions->lists('id')->toArray());

                $role->permissions()->attach(\Input::get('permissions'));
            }

            if ($role->permissions->count() == 0 && count(\Input::get('permissions')) > 0) {
                $role->permissions()->attach(\Input::get('permissions'));
            }

            return redirect()->route('admin.roles.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return redirect()->route('admin.roles.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }
}
