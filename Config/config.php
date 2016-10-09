<?php

return [
	'name' => 'Admin',
	'widgets' => '',
	'prefix' => 'admin',
    'user' => [
        'model' => 'Modules\Admin\Entities\User',
        'perpage' => 10
    ],
    'role' => [
        'model' => 'Modules\Admin\Entities\Role',
        'perpage' => 10
    ],
    'permission' => [
        'model' => 'Modules\Admin\Entities\Permission',
        'perpage' => 10
    ],
];