<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(codeproject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});



$factory->define(codeproject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' =>$faker->address,
        'obs' => $faker->sentence
    ];
});


$factory->define(codeproject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1,10),
        'client_id' => rand(1,10),
        'name' => $faker->word,
        'description' => $faker->sentence,
        'progress' =>rand(1,100),
        'status' => rand(1,3),
        'due_date' => $faker->dateTime('now'),
    ];
});

$factory->define(codeproject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'proj_id' => rand(1,10),
        'title'=>$faker->title,
        'note'=>$faker->sentence,
    ];
});

$factory->define(codeproject\Entities\ProjectFile::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'name'=>$faker->name,
        'description'=>$faker->sentence,
        'extension'=>$faker->fileExtension,
    ];
});