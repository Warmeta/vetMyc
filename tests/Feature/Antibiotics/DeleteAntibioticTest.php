<?php

namespace Tests\Feature\Antibiotics;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class DeleteAntibioticTest extends TestCase
{
  // use WithoutMiddleware;

  public function testDeleteAntibioticFailWithoutLoginUser()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);
    $response = $this->delete('/lab/antibiotic/delete/' . $antibiotic['id']);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('antibiotics', $antibiotic);
  }

  public function testDeleteAntibioticAsAdminSuccess()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $user = $this->createUserWithAdminPermissions('antibiotics');

    $response = $this
      ->actingAs($user)
      ->delete('/lab/antibiotic/delete/' . $antibiotic['id']);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('antibiotics', $antibiotic);
  }

  public function testDeleteAntibioticFailLogedAsUser()
  {
    $antibiotic = factory('App\Antibiotic')->create()->toArray();
    $this->assertDatabaseHas('antibiotics', $antibiotic);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/lab/antibiotic/delete/' . $antibiotic['id']);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('antibiotics', $antibiotic);
  }
}
