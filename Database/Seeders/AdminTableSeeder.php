<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class AdminTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => str_random(10),
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'language' => 'en',
            'status' => 1,
            'level' => 1
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
			'description'=>'Administrator'
        ]);
		DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);
		DB::table('permissions')->insert([
            [ 
                'name' => 'Manage users',
                'slug' => 'manage-users',
                'description'=>'Manage users'
            ],
            [ 
                'name' => 'Manage Roles',
                'slug' => 'manage-roles',
                'description'=>'Manage roles'
            ],
            [ 
                'name' => 'Manage permissions',
                'slug' => 'manage-permissions',
                'description'=>'Manage permissions'
            ],
            [ 
                'name' => 'Manage Modules',
                'slug' => 'manage-modules',
				'description'=>'Manage modules'
            ]
        ]);

		DB::table('permission_role')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1
            ],
            [
                'permission_id' => 2,
                'role_id' => 1
            ],
            [
                'permission_id' => 3,
                'role_id' => 1
            ],
            [
    			'permission_id' => 4,
                'role_id' => 1
            ]
        ]);
		Model::unguard();
		
		// $this->call("OthersTableSeeder");
	}

}