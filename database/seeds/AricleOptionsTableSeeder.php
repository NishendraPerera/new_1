<?php

use Illuminate\Database\Seeder;

class AricleOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\ArticleOption([
        	'name' => 'Local',    	
        	]);
        $role->save();

        $role = new \App\ArticleOption([
        	'name' => 'International',
        	]);
        $role->save();

    }
}
