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
        $colors = [
            'AZUL',
            'ROJO',
            'VERDE',
            'MARRON',
            'BLANCO'
            ];
        foreach ($colors as $index => $value) {
            DB::table('colors')->insert([
                'name' => $value,
                'hex' => '#ccc'
                ]);
        }
    }
}
