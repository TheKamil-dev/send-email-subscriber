<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($w=1; $w<=5; $w++){

            $website = Website::find($w);
            Log::info("message");
            if(empty($website))
            {

                $website = new Website();
                $website->website_name = 'website_'.$w;
                $website->save();

            }

        }
    }
}
