<?php

use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('configuration')->insert([
            'key' => 'home_products',
            'value' => '["1","2","3"]'
        ]);
    }
}
