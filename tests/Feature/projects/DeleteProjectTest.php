<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class DeleteProjectTest extends TestCase
{
  public function testDeleteProjectFailWithoutLoginUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);
    $response = $this->delete('/project-manager/delete/' . $project['id']);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('projects', $project);
  }

  public function testDeleteProjectAsAdminSuccess()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->delete('/project-manager/delete/' . $project['id']);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('projects', $project);
  }

  public function testDeleteProjectFailLogedAsUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/project-manager/delete/' . $project['id']);

    $response->assertRedirect('/')
      ->assertStatus(302);
    $this->assertDatabaseHas('projects', $project);
  }
}
