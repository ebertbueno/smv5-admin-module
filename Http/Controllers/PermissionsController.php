<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Repositories\Permissions\PermissionRepository;
use Modules\Admin\Validation\Permission\Create;
use Modules\Admin\Validation\Permission\Update;

class PermissionsController extends Controller
{
    protected $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->middleware("roles:admin");
        $this->middleware("permissions:manage-permissions");

        $this->repository = $repository;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display a listing of permissions.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->repository->allOrSearch(Input::get('q'));

        $no = $permissions->firstItem();

        return View('admin::permissions.index', compact('permissions', 'no'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return Response
     */
    public function create()
    {
        return View('admin::permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $permission = $this->repository->findById($id);

            return View('admin::permissions.show', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $permission = $this->repository->findById($id);

            return View('admin::permissions.edit', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Update the specified permission in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $permission = $this->repository->findById($id);

            $data = $request->all();

            $permission->update($data);

            return redirect()->route('admin.permissions.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return redirect()->route('admin.permissions.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }
}
