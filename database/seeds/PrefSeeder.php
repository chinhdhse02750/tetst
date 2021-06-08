<?php

use Illuminate\Database\Seeder;

class PrefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pref = config('pref');
        DB::table('pref')->insert($pref['pref']);
    }
}
