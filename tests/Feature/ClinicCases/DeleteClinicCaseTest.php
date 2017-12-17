<?php

namespace Tests\Feature\ClinicCases;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class DeleteClinicCaseTest extends TestCase
{
  public function testDeleteClinicCaseFailWithoutLoginUser()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
    $response = $this->delete('/lab/clinic-case/delete/' . $clinicCase['id']);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }

  public function testDeleteClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
      ->actingAs($user)
      ->delete('/lab/clinic-case/delete/' . $clinicCase['id']);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('clinic_cases', $clinicCase);
  }

  public function testDeleteClinicCaseFailLogedAsUser()
  {
    $clinicCase = factory('App\ClinicCase')->create()->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/lab/clinic-case/delete/' . $clinicCase['id']);

    $response->assertRedirect('/')
      ->assertStatus(302);
    $this->assertDatabaseHas('clinic_cases', $clinicCase);
  }
}
