<?php

namespace Tests\Feature\ClinicCases;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class UpdateClinicCaseTest extends TestCase
{
  public function testUpdateClinicCaseFailWithoutLoginUser()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $clinicCase2 = factory('App\ClinicCase')->make()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
    $response = $this->put('/lab/clinic-case/' . $clinicCase['id'] . '/edit', $clinicCase2);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }

  public function testUpdateClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $clinicCase2 = factory('App\ClinicCase')->make()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->put('/lab/clinic-case/' . $clinicCase['id'] . '/edit', $clinicCase2);
    $response->assertStatus(302)->assertRedirect('/lab/clinic-case');
    $this->assertDatabaseHas('clinic_cases', $clinicCase2);
  }

  public function testUpdateClinicCaseFailLogedAsUser()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $clinicCase2 = factory('App\ClinicCase')->make()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
    ->actingAs($user)
    ->put('/lab/clinic-case/' . $clinicCase['id'] . '/edit', $clinicCase2);
    $response->assertStatus(302)
    ->assertRedirect('/');
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }
}
