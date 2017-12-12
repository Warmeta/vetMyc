<?php

namespace Tests\Feature\Antibiotics;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class CreateAntibioticTest extends TestCase
{
  // use WithoutMiddleware;

  public function testCreateAntibioticFailWithoutLoginUser()
  {
    $antibiotic = factory('App\Antibiotic')->make()->toArray();
    $response = $this->call('POST', '/lab/antibiotic/create', $antibiotic, [], [], []);
    $response->assertStatus(302)->assertRedirect('/');
  }

  public function testCreateAntibioticFailWithoutRequiredParameterAsAdmin()
  {
    $antibiotic = factory('App\Antibiotic')->make(['antibiotic_name' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('antibiotics');

    $response = $this
      ->actingAs($user)
      ->post('/lab/antibiotic/create', $antibiotic);

    $response->assertRedirect('/lab/antibiotic/create')
      ->assertSessionHasErrors(['antibiotic_name']);
    $this->assertDatabaseMissing('antibiotics', $antibiotic);
  }

  public function testCreateAntibioticSuccessAsAdmin()
  {
    $antibiotic = factory('App\Antibiotic')->make()->toArray();

    $user = $this->createUserWithAdminPermissions('antibiotics');

    $response = $this
      ->actingAs($user)
      ->post('/lab/antibiotic/create', $antibiotic);

    $response->assertRedirect('/lab/antibiotic')
      ->assertStatus(302);
    $this->assertDatabaseHas('antibiotics', $antibiotic);
  }

  public function testCreateAntibioticFailLogedAsUser()
  {
    $antibiotic = factory('App\Antibiotic')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->post('/lab/antibiotic/create', $antibiotic);

    $response->assertRedirect('/');
    $this->assertDatabaseMissing('antibiotics', $antibiotic);
  }
}
