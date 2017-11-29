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
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Antibiotic::class, function (Faker\Generator $faker) {
    return [
        'antibiotic_name' => $faker->name,
        'description' => $faker->paragraph(2),
    ];
});

$factory->define(App\ClinicCase::class, function (Faker\Generator $faker) {
       return ['number_clinic_history' => $faker->randomNumber(8),
        'author_id' => 1,
        'ref_animal' => $faker->randomNumber(8),
        'specie' => $faker->word,
        'clinic_history' => $faker->paragraph(2),
        'owner' => $faker->name,
        'owner_email' => $faker->email,
        'breed' => $faker->name,
        'sex' => $faker->randomElement($array = array ('male','female')),
        'age' => $faker->randomNumber(1),
        'localization' => $faker->randomElement($array = array (
            'skin',
            'eye',
            'mouth',
            'nose',
            'nail',
            'hair',
            'ear',
            'blood',
            'biopsy',
            'bodyfluids',
            'feces',
            'urine',
            'others')
        ),
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

$factory->define(App\Project::class, function (Faker\Generator $faker) {
       return ['project_name' => $faker->lastname,
        'description' => $faker->paragraph(1),
        'image' => 'settings/March2017/eJo0qPme5R7np2HtdjDT.png',
        'project_type' => $faker->word,
        'research_line' => $faker->word,
        'publication_date' => Carbon::create(2015, 5, 28, 0, 0, 0),
        'entity' => 'ULPGC',
        'author_id' => 1,
        'project_status' => $faker->randomElement($array = array ('inprogress','finished')),
        'link' => 'www.ulpgc.es',
        'file' => 'settings/March2017/eJo0qPme5R7np2HtdjDT.png',
    ];
});
