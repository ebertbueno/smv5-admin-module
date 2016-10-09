<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => str_random(10),
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'language' => 'pt-br',
            'status' => 1,
            'level' => 'admin'
        ]);
    }
}
