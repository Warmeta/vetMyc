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

  public function testIndexFilterStateInProgressClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create(['clinic_case_status' => 'inprogress'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=inprogress');
    $response->assertStatus(200)
    ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterStateInProgressClinicCaseAsAdminFailWithNoClinicCaseAssociated()
  {
    $clinicCase = factory('App\ClinicCase')->create(['clinic_case_status' => 'finished'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=inprogress');
    $response->assertStatus(200)
    ->assertDontSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterStateFinishedClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create(['clinic_case_status' => 'finished'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=finished');
    $response->assertStatus(200)
    ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterStateFinishedClinicCaseAsAdminFailWithNoClinicCaseAssociated()
  {
    $clinicCase = factory('App\ClinicCase')->create(['clinic_case_status' => 'inprogress'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=finished');
    $response->assertStatus(200)
    ->assertDontSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterBacterialIsolateClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create(['bacterial_isolate' => 'test'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=bacterial_isolate');
    $response->assertStatus(200)
    ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterBacterialIsolateClinicCaseAsAdminFailWithNoClinicCaseAssociated()
  {
    $clinicCase = factory('App\ClinicCase')->create(['bacterial_isolate' => null])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=bacterial_isolate');
    $response->assertStatus(200)
    ->assertDontSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterFungiIsolateClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create(['fungi_isolate' => 'test'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=fungi_isolate');
    $response->assertStatus(200)
    ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterFungiIsolateClinicCaseAsAdminFailWithNoClinicCaseAssociated()
  {
    $clinicCase = factory('App\ClinicCase')->create(['fungi_isolate' => null])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=&filter=fungi_isolate');
    $response->assertStatus(200)
    ->assertDontSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterLocalizationClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create(['localization' => 'ear'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=ear&number_clinic_history=&filter=localization');
    $response->assertStatus(200)
    ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterLocalizationClinicCaseAsAdminFailWithNoClinicCaseAssociated()
  {
    $clinicCase = factory('App\ClinicCase')->create(['localization' => 'skin'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=ear&number_clinic_history=&filter=localization');
    $response->assertStatus(200)
    ->assertDontSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterNumberClinicCaseAsAdminSuccess()
  {
    $clinicCase = factory('App\ClinicCase')->create(['number_clinic_history' => '321'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=321&filter=number_clinic_history');
    $response->assertStatus(200)
    ->assertSee((string)$clinicCase['number_clinic_history']);
  }

  public function testIndexFilterNumberClinicCaseAsAdminFailWithNoClinicCaseAssociated()
  {
    $clinicCase = factory('App\ClinicCase')->create(['number_clinic_history' => '123'])->toArray();
    $this->assertDatabaseHas('clinic_cases', $clinicCase);

    $user = $this->createUserWithAdminPermissions('clinic_cases');

    $response = $this
    ->actingAs($user)
    ->get('/lab/clinic-case?localization=&number_clinic_history=321&filter=number_clinic_history');
    $response->assertStatus(200)
    ->assertDontSee((string)$clinicCase['number_clinic_history']);
  }
}
