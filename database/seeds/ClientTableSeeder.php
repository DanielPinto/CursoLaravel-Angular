<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Client::truncate();
        factory(\codeproject\Entities\Client::class , 10)->create();
    }
}
