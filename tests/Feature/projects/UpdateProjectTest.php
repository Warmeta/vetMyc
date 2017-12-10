<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class UpdateProjectTest extends TestCase
{
  // use WithoutMiddleware;

  public function testUpdateProjectFailWithoutLoginUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $clinicCase2 = factory('App\Project')->make()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);
    $response = $this->put('/project-manager/' . $clinicCase['id'] . '/edit', $clinicCase2);
    $response->assertStatus(302)->assertRedirect('/login');
    $this->assertDatabaseHas('projects', $clinicCase);
  }

  public function testUpdateProjectAsAdminSuccess()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $clinicCase = factory('App\Project')->create()->toArray();
    $clinicCase2 = factory('App\Project')->make(['project_name' => 'test' ,'image' => $image])->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->put('/project-manager/' . $clinicCase['id'] . '/edit', $clinicCase2);
    $response->assertStatus(302)->assertRedirect('/project-manager');
    $this->assertDatabaseHas('projects', array_splice($clinicCase2, 0, 1));
  }

  public function testUpdateProjectFailLogedAsUser()
  {
    $clinicCase = factory('App\Project')->create()->toArray();
    $clinicCase2 = factory('App\Project')->make()->toArray();
    $this->assertDatabaseHas('projects', $clinicCase);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->put('/project-manager/' . $clinicCase['id'] . '/edit', $clinicCase2);
    $response->assertStatus(302)
      ->assertRedirect('/');
    $this->assertDatabaseHas('projects', $clinicCase);
  }
}
