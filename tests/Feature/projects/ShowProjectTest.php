<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class ShowProjectTest extends TestCase
{
  // use WithoutMiddleware;

  public function testShowProjectAsUserSuccess()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $response = $this->get('/project-manager/' . $project['id']);
    $response->assertStatus(200)->assertSee((string)$project['project_name']);
  }

  public function testShowProjectAsAdminSuccess()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->get('/project-manager/' . $project['id']);
    $response->assertStatus(200)->assertSee((string)$project['project_name']);
  }

  public function testShowProjectFailLogedAsUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/project-manager/' . $project['id']);
    $response->assertStatus(200)->assertSee((string)$project['project_name']);
  }
}
