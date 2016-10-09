<?php

namespace Modules\Admin\Composers;

use Modules\Admin\Entities\Permission;

class RoleFormComposer
{
    public function compose($view)
    {
        $permissions = Permission::lists('name', 'id');

        $view->with(compact('permissions'));
    }
}
