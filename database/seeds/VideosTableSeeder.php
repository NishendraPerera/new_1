<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = array(
            [ 'title' => "Video 1", 'description' => "This is the description<br>" ],
            [ 'title' => "Video 2", 'description' => "This is the description<br>" ],
            [ 'title' => "Video 3", 'description' => "This is the description<br>" ],
            [ 'title' => "Video 4", 'description' => "This is the description<br>" ],
        );

        foreach($videos AS $data){
            $video = new \App\Video;
            $video->user_id = 1;
            $video->title = $data['title'];
            $video->description = $data['description'];
            $video->thumbnail_file_name       = '5e17908ab33c2-seed.png';
            $video->thumbnail_link            = url('/').'/uploads/videos/thumbnail/' . '5e17908ab33c2-seed.png';
            $video->file_name       = '5e17908ab33c2-seed.mp4';
            $video->link            = url('/').'/uploads/videos/' . '5e17908ab33c2-seed.mp4';
            $video->save();
        }
    }
}
