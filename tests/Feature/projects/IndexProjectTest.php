<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class IndexProjectTest extends TestCase
{
  // use WithoutMiddleware;

  public function testIndexProjectFailWithoutLoginUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);
    $response = $this->get('/project-manager');
    $response->assertStatus(302)->assertRedirect('/login');
    $this->assertDatabaseHas('projects', $clinicCase);
  }

  public function testIndexProjectAsAdminSuccess()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->get('/project-manager');
    $response->assertStatus(200)
      ->assertSee((string)$clinicCase['project_name']);
  }

  public function testIndexProjectFailLogedAsUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/project-manager');
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
