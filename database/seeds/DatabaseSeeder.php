<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ArticleOptionsTableSeeder::class);
        $this->call(AdvertisementsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(AdPricesTableSeeder::class);
    }
}
