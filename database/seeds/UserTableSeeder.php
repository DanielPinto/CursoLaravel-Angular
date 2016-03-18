<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\codeproject\Entities\User::class)->create([
            'name' => 'Daniel Pinto',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),

        ]);


        factory(\codeproject\Entities\User::class , 10)->create();
    }
}
