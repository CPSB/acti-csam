<?php

use ActivismeBE\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the users table.
        DB::table('users')->delete();

        // Create system user.
        factory(\ActivismeBE\User::class)->create([
            'id'    => 1,
            'name'  => 'Informatica Dienst',
            'email' => 'informatica@activisme.be'
        ]);

        // Seeding the database table.
        $user = factory(User::class)->create();

        User::find($user->id)->assginRole('admin');
        User::find($user->id)->assignRole('supervisor');

        $this->command->info("Email: {$user->email}");
        $this->command->info("Password: secret");
    }
}
