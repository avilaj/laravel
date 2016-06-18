<?php

use Illuminate\Database\Seeder;
use \App\Model\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'jorge.e.avila@gmail.com',
            'password' => '200345'
        ]);
    }
}
