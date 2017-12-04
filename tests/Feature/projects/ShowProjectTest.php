<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class ShowProjectTest extends TestCase
{
  // use WithoutMiddleware;

  public function testShowProjectFailWithoutLoginUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $response = $this->get('/project-manager/' . $clinicCase['id']);
    $response->assertStatus(302)->assertRedirect('/login');
    $this->assertDatabaseHas('projects', $clinicCase);
  }

  public function testShowProjectAsAdminSuccess()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->get('/project-manager/' . $clinicCase['id']);
    $response->assertStatus(200)->assertSee((string)$clinicCase['project_name']);
  }

  public function testShowProjectFailLogedAsUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/project-manager/' . $clinicCase['id']);
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
