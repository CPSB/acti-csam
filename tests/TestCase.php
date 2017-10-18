<?php

namespace Tests;

use ActivismeBE\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create a test admin user.
     *
     * @return mixed
     */
    public function createAdmin()
    {
        $user = factory(User::class)->create();
        $role = Role::create(['name' => 'admin']);

        return User::find($user->id)->assignRole($role->name);
    }

    /**
     * Create test supervisor user.
     *
     * @return mixed
     */
    public function createSuperVisor()
    {
        $user = factory(User::class)->create();
        $role = Role::create(['name' => 'supervisor']);

        return User::find($user->id)->assignRole($role->name);
    }
}
