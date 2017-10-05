<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('roles')->delete(); // truncate the roles table.

        // TODO; Create user and supervisor role.
        //       Alse need to document them in the internals repo.

        // Seeding the role table.
        Role::create(['name' => 'admin']);
    }
}
