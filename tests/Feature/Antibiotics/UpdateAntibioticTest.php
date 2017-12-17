<?php

namespace Tests\Feature\Antibiotics;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class UpdateAntibioticTest extends TestCase
{
  public function testUpdateAntibioticFailWithoutLoginUser()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $antibiotic2 = factory('App\Antibiotic')->make()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);
    $response = $this->put('/lab/antibiotic/' . $antibiotic['id'] . '/edit', $antibiotic2);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('antibiotics', $antibiotic);
  }

  public function testUpdateAntibioticAsAdminSuccess()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $antibiotic2 = factory('App\Antibiotic')->make()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $user = $this->createUserWithAdminPermissions('antibiotics');

    $response = $this
    ->actingAs($user)
    ->put('/lab/antibiotic/' . $antibiotic['id'] . '/edit', $antibiotic2);
    $response->assertStatus(302)->assertRedirect('/lab/antibiotic');
    $this->assertDatabaseHas('antibiotics', $antibiotic2);
  }

  public function testUpdateAntibioticFailLogedAsUser()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $antibiotic2 = factory('App\Antibiotic')->make()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $user = $this->createUserWithUserPermissions();

    $response = $this
    ->actingAs($user)
    ->put('/lab/antibiotic/' . $antibiotic['id'] . '/edit', $antibiotic2);
    $response->assertStatus(302)
    ->assertRedirect('/');
    $this->assertDatabaseHas('antibiotics', $antibiotic);
  }
}
