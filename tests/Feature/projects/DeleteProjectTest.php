<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class DeleteProjectTest extends TestCase
{
  // use WithoutMiddleware;

  public function testDeleteProjectFailWithoutLoginUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);
    $response = $this->delete('/project-manager/delete/' . $clinicCase['id']);
    $response->assertStatus(302)->assertRedirect('/login');
    $this->assertDatabaseHas('projects', $clinicCase);
  }

  public function testDeleteProjectAsAdminSuccess()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->delete('/project-manager/delete/' . $clinicCase['id']);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('projects', $clinicCase);
  }

  public function testDeleteProjectFailLogedAsUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/project-manager/delete/' . $clinicCase['id']);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('projects', $clinicCase);
  }
}