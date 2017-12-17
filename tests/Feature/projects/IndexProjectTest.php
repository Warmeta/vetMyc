<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class IndexProjectTest extends TestCase
{
  public function testIndexProjectFailWithoutLoginUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);
    $response = $this->get('/project-manager');
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('projects', $project);
  }

  public function testIndexProjectAsAdminSuccess()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->get('/project-manager');
    $response->assertStatus(200)
      ->assertSee((string)$project['project_name']);
  }

  public function testIndexProjectFailLogedAsUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/project-manager');
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
