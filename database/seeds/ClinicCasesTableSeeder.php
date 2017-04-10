<?php

use App\ClinicCase;
use Illuminate\Database\Seeder;

class ClinicCasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            factory(ClinicCase::class)->create();
        }
    }
}
