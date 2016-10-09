<?php

namespace Modules\Admin\Repositories\Roles;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Admin\Repositories\Role\RoleRepository as RoleRep;
use Modules\Admin\Entities\Role;

class EloquentRoleRepository extends BaseRepository implements RoleRepository
{
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function perPage()
    {
        return config('admin.role.perpage');
    }

    public function getModel()
    {
        $model = config('admin.role.model');

        return new $model();
    }

    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }

        return $this->search($searchQuery);
    }

    public function getAll()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
        ;
    }

    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    public function delete($id)
    {
        $article = $this->findById($id);

        if (!is_null($article)) {
            $article->delete();

            return true;
        }

        return false;
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }
}
