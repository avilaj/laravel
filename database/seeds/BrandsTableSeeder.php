<?php

use Illuminate\Database\Seeder;
use \App\Model\Brand;


class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Vans',
            'Creature',
            'Volcom',
            'Santa cruz',
            'Flip',
            'Nike',
            'Circa',
            'DC'
        ];
        $add = function ($name) {
            return Brand::create([
                'name' => $name
            ]);
        };
        array_map($add, $names);
    }
}
