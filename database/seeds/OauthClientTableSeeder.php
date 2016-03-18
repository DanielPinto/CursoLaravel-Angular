<?php

use Illuminate\Database\Seeder;

class OauthClientTableSeeder extends Seeder
{
    /**
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(\codeproject\Entities\OauthClient::class)->create(
            [
                'id' => 'appid1',
                'secret' => 'secret',
                'name' => 'AngularAPP',
            ]
        );

    }
}
