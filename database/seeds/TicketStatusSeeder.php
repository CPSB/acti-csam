<?php

use ActivismeBE\Statusses;
use ActivismeBE\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class TicketStatusSeeder
 */
class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // #2ECC40 -> GREEN
        // #FF4136 -> RED
        // 'color', 'name', 'description' -> mass-assign fields

        DB::table('statusses')->delete(); // Truncate the database table.

        $system = User::find(1);

        Statusses::create(['author_id' => $system->id, 'name' => 'open', 'color' => '#2ecc40', 'description' => 'Gebruikt voor open tickets zonder toewijzing.']);
        Statusses::create(['author_id' => $system->id, 'name' => 'pending', 'color' => '#2eec40', 'description' => 'Gebruikt voor open tickets waar een admin is toegewezen.']);
        Statusses::create(['author_id' => $system->id, 'name' => 'fixed', 'color' => '#ff4136', 'description' => 'Gebruikt voor open ticketten. waar al een fix voor is.']);
        Statusses::create(['author_id' => $system->id, 'name' => 'closed', 'color' => '#ff4136', 'description' => 'Gebruikt voor gesloten ticketten.']);
    }
}
