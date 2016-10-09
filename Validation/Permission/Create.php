<?php

namespace Modules\Admin\Validation\Permission;

use Modules\Admin\Validation\Validator;

class Create extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:permissions,slug',
        ];
    }
}
