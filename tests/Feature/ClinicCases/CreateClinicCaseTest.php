<?php

namespace Tests\Feature\ClinicCases;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateClinicCaseTest extends TestCase
{
  // use WithoutMiddleware;

  public function testCreateClinicCaseFailWithoutLogin()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $response = $this->call('POST', '/lab/clinic-case', $clinicCase, [], [], []);
    $response->assertStatus(405);
  }

  public function testCreateClinicCaseFailWithoutNumberClinicParameter()
  {
    $clinicCase = factory('App\ClinicCase')->create(['number_clinic_history' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
      ->actingAs($user)
      ->post('/lab/clinic-case/create', $clinicCase);

    $response->assertRedirect('/lab/clinic-case/create');
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }
}
