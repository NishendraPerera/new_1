<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = array(
            [ 'content' => "Although historically Japan did not have any conflicts with Sri Lanka, the Japanese had disputes with Sri Lanka during the second world war as a result of Sri Lanka’s affiliation with Britain. The Japanese forces captured Singapore in 1942 in the second world war." ],
            [ 'content' => "Sri Lanka known as Ceylon at the time was next in line. The Southern coast of the country extending from Koggala was constantly under the watch of the Allied Air Force and Allied Forces. On April 4th in 1942, observers learned, that the Japanese Air Force and Naval Force was reaching Sri Lanka." ],
            [ 'content' => "According to the information received, the Colombo British officers had the Air Force on alert and armed and on 5th of April in 1942, on Easter Sunday, with Japanese Air Force reaching, the allied forces attacked the Japanese aircraft." ],
            [ 'content' => "The reports state that the Japanese military might which included 27 aircraft were destroyed. Looking back into the past it is clear that Sri Lanka became a target of the Japanese as a result of our affiliation with Britain. Similarly maintaining strong bonds with America will make Sri Lanka a target of Iran in this present context." ],
        );

        foreach($sliders AS $key => $data)
        {
            $slider = new \App\Slider;
            $slider->title          = "Title ".($key+1);
            $slider->description    = $data['content'];
            $slider->file_name      = '5e17695c5a40f-seed.png';
            $slider->link           = url('/').'/uploads/sliders/' . '5e17695c5a40f-seed.png';
            $slider->save();
        }
    }
}
