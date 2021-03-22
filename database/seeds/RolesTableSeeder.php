<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Role([
        	'name' => 'Admin',    	
        	]);
        $role->save();

        $role = new \App\Role([
        	'name' => 'Editor',    	
        	]);
        $role->save();

        $role = new \App\Role([
        	'name' => 'User',    	
        	]);
        $role->save();
    }
}
