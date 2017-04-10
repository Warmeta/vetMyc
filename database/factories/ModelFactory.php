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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\ClinicCase::class, function (Faker\Generator $faker) {
       return ['number_clinic_history' => $faker->randomNumber(8),
        'author_id' => 1,
        'ref_animal' => $faker->randomNumber(8),
        'specie' => $faker->word,
        'clinic_history' => $faker->paragraph(2),
        'owner' => $faker->name,
        'breed' => $faker->name,
        'sex' => $faker->randomElement($array = array ('male','female')),
        'age' => $faker->randomNumber(1),
        'localization' => $faker->randomElement($array = array ('eye','mouth','skin','hair','blood')),
        'clinic_case_status' => $faker->randomElement($array = array ('inprogress','finished')),
        'sample' => $faker->word,
        'bacterioscopy' => $faker->word,
        'trichogram' => $faker->word,
        'culture' => $faker->word,
        'bacterial_isolate' => $faker->word,
        'fungi_isolate' => $faker->word,
        'comment' => $faker->paragraph(2),
    ];
});