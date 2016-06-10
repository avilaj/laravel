<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
        	'name' => 'Black',
        	'hex' => '#000'
        ]);
        DB::table('colors')->insert([
        	'name' => 'White',
        	'hex' => '#fff'
        ]);
        DB::table('colors')->insert([
        	'name' => 'Blue',
        	'hex' => '#0000FF'
        ]);
        DB::table('colors')->insert([
        	'name' => 'Red',
        	'hex' => '#C00000'
        ]);
        DB::table('colors')->insert([
        	'name' => 'Green',
        	'hex' => '#009000'
        ]);
    }
}
