<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class RoleTableSeeder
 */
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO; Create user and supervisor role.
        //       Alse need to document them in the internals repo.
        Role::create(['name' => 'admin']);
    }
}
