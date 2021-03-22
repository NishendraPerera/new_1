<?php

use Illuminate\Database\Seeder;

class AdvertisementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['Quater', 'Half', 'Full', 'Classifieds'];

        foreach($sizes AS $data){
            $size = new \App\AdSize;
            $size->name = $data;
            $size-> save();
        }

        //  $prices = ['1000', '2000', '3000', '4000'];

        // foreach($prices AS $data){
        //     $price = new \App\Adprice;
        //     $price->name = $data;
        //     $price-> save();
        // }
        $categories = ['Marriage', 'Jobs', 'Business Promotions', 'Tourism'];

        foreach($categories AS $data){
            $category = new \App\AdCategory;
            $category->name = $data;
            $category-> save();
        }

        $colours = ['Black', '4 Colours'];

        foreach($colours AS $data){
            $colour = new \App\AdColour;
            $colour->name = $data;
            $colour-> save();
        }

        $languages = ['Sinhala', 'English'];

        foreach($languages AS $data){
            $language = new \App\AdLanguage;
            $language->name = $data;
            $language-> save();
        }

    }
}
