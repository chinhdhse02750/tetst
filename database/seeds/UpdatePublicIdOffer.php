<?php

use App\Entities\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdatePublicIdOffer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = Offer::where('public_id', '=', '')->get();

        if($offers->count() > 0) {
            try {
                DB::beginTransaction();
                foreach ($offers as $offer) {
                    $offer->public_id = (string) Str::random(8);
                    $offer->save();
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }

    }
}
