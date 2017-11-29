<?php

namespace Tests\Feature\ClinicCases;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class IndexClinicCaseTest extends TestCase
{
  // use WithoutMiddleware;

  public function testIndexClinicCaseFailWithoutLoginUser()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
    $response = $this->get('/lab/clinic-case');
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }

  public function testIndexClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
      ->actingAs($user)
      ->get('/lab/clinic-case');
    $response->assertStatus(200)
      ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexClinicCaseFailLogedAsUser()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/lab/clinic-case');
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
