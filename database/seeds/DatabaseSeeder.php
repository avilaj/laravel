<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        // $this->call(ColorsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        // $this->call(GalleriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        // $this->call(PersonsTableSeeder::class);
        // $this->call(NewsTableSeeder::class);
        // $this->call(ConfigurationTableSeeder::class);
        $this->call(OrdersTableSeeder::class);

        Model::reguard();
    }
}
