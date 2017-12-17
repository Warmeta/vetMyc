<?php

namespace Tests\Feature\ClinicCases;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class CreateClinicCaseTest extends TestCase
{
  public function testCreateClinicCaseFailWithoutLoginUser()
  {
    $clinicCase = factory('App\ClinicCase')->make()->toArray();
    $response = $this->call('POST', '/lab/clinic-case/create', $clinicCase, [], [], []);
    $response->assertStatus(302)->assertRedirect('/');
  }

  public function testCreateClinicCaseFailWithoutRequiredParameterAsAdmin()
  {
    $clinicCase = factory('App\ClinicCase')->make(['number_clinic_history' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->post('/lab/clinic-case/create', $clinicCase);

    $response->assertRedirect('/lab/clinic-case/create')
    ->assertSessionHasErrors(['number_clinic_history']);
    $this->assertDatabaseMissing('clinic_cases', $clinicCase);
  }

  public function testCreateClinicCaseSuccessAsAdmin()
  {
    $clinicCase = factory('App\ClinicCase')->make()->toArray();

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->post('/lab/clinic-case/create', $clinicCase);

    $response->assertRedirect('/lab/clinic-case')
    ->assertStatus(302);
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }

  public function testCreateClinicCaseFailLogedAsUser()
  {
    $clinicCase = factory('App\ClinicCase')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
    ->actingAs($user)
    ->post('/lab/clinic-case/create', $clinicCase);

    $response->assertRedirect('/')
    ->assertStatus(302);
    $this->assertDatabaseMissing('clinic_cases', $clinicCase);
  }
}
