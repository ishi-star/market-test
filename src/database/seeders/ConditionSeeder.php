<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('conditions')->insert([
        ['condition' => '良好'],
        ['condition' => '目立った傷や汚れなし'],
        ['condition' => 'やや傷や汚れあり'],
        ['condition' => '状態が悪い'],
    ]);
    }
}
