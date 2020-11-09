<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Entities\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Area::count() === 0) {
            $userConfig = config('user-profile');
            $areas  = $userConfig['areas'];
            DB::table('areas')->insert($areas);
        }
    }
}
