<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
        	'name' => 'Admin',
            'email' => 'a@b.com',
            'password' => Hash::make('p'),
            'role_id' => 1        	
        	]);
        $user->save();

        $user = new \App\User([
        	'name' => 'Editor',
            'email' => 'e@b.com',
            'password' => Hash::make('p'),
            'role_id' => 2        	
        	]);
        $user->save();

        $user = new \App\User([
        	'name' => 'User',
            'email' => 'u@b.com',
            'password' => Hash::make('p'),
            'role_id' => 3
        	]);
        $user->save();
    }
}
