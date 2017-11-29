<?php

namespace Tests\Feature\Antibiotics;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class ShowAntibioticTest extends TestCase
{
  // use WithoutMiddleware;

  public function testShowAntibioticFailWithoutLoginUser()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $response = $this->get('/lab/antibiotic/' . $antibiotic['id']);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('antibiotics', $antibiotic);
  }

  public function testShowAntibioticAsAdminSuccess()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $user = $this->createUserWithAdminPermissions('antibiotics');

    $response = $this
      ->actingAs($user)
      ->get('/lab/antibiotic/' . $antibiotic['id']);
    $response->assertStatus(200)->assertSee((string)$antibiotic['antibiotic_name']);
  }

  public function testShowAntibioticFailLogedAsUser()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/lab/antibiotic/' . $antibiotic['id']);
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
