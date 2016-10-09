<?php

namespace Modules\Admin\Validation\Role;

use Modules\Admin\Validation\Validator;

class Create extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:roles,slug',
        ];
    }
}
