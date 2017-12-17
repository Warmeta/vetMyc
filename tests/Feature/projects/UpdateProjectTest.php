<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class UpdateProjectTest extends TestCase
{
  

  public function testUpdateProjectFailWithoutLoginUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $project2 = factory('App\Project')->make()->toArray();
    $this->assertDatabaseHas('projects', $project);
    $response = $this->put('/project-manager/' . $project['id'] . '/edit', $project2);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('projects', $project);
  }

  public function testUpdateProjectAsAdminSuccess()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $project = factory('App\Project')->create()->toArray();
    $project2 = factory('App\Project')->make(['project_name' => 'test' ,'image' => $image])->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->put('/project-manager/' . $project['id'] . '/edit', $project2);
    $response->assertStatus(302)->assertRedirect('/project-manager');
    $this->assertDatabaseHas('projects', array_splice($project2, 0, 1));
  }

  public function testUpdateProjectFailLogedAsUser()
  {
    $project = factory('App\Project')->create()->toArray();
    $project2 = factory('App\Project')->make()->toArray();
    $this->assertDatabaseHas('projects', $project);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->put('/project-manager/' . $project['id'] . '/edit', $project2);
    $response->assertStatus(302)
      ->assertRedirect('/');
    $this->assertDatabaseHas('projects', $project);
  }
}
