<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Model\Size;
use App\Model\Reference;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $references = DB::table('references')->pluck('id');
        $calzado = \App\Model\Type::create(['label'=>'calzado']);
        $vestimenta = \App\Model\Type::create(['label'=>'vestimenta']);
        foreach (range(35, 46) as $talle) {
            # code...
            $size = ['label' => $talle];
            $calzado->sizes()->create($size);
        }
        $clothesSizes = ['xs', 's', 'm', 'l','xl', 'xxl'];
        foreach ($clothesSizes as $talle) {
            Size::create(['label' => $talle]);
        }
    }
}
