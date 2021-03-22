<?php

use Illuminate\Database\Seeder;

class AdPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=4; $i++){

            $base_price = $i*500*rand(1, 3);

            for($j=1; $j<=2; $j++){
                $price = new \App\Adprice;
                $price->size_id = $i;
                $price->colour_id = $j;
                $price->price = $base_price + $j*1000;
                $price->save();
            }
        }
    }
}
