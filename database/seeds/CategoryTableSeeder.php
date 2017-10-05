<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryTableSeeder
 */
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['color' => '#ff0060', 'name' => 'client', 'module' => 'support-desk', 'description' => 'Word gebruikt voor een probleem in 1 van onze clients.'];

        $table = DB::table('categories');
        $table->delete();
        $table->insert($categories);
    }
}
