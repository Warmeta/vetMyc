<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class CreateProjectTest extends TestCase
{
  // use WithoutMiddleware;

  public function testCreateProjectFailWithoutLoginUser()
  {
    $clinicCase = factory('App\Project')->make()->toArray();
    $response = $this->call('POST', '/project-manager', $clinicCase, [], [], []);
    $response->assertStatus(405);
  }

  public function testCreateProjectFailWithoutRequiredParameterAsAdmin()
  {
    $clinicCase = factory('App\Project')->make(['project_name' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->post('/project-manager/create', $clinicCase);

    $response->assertRedirect('/project-manager/create')
      ->assertSessionHasErrors(['project_name']);
    $this->assertDatabaseMissing('projects', $clinicCase);
  }

  public function testCreateProjectSuccessAsAdmin()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $clinicCase = factory('App\Project')->make(['image' => $image])->toArray();
    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->post('/project-manager/create', $clinicCase);
    $response->assertRedirect('/project-manager')
      ->assertStatus(302);
    $this->assertDatabaseHas('projects', array_splice($clinicCase, 0, 1));
  }

  public function testCreateProjectFailLogedAsUser()
  {
    $clinicCase = factory('App\Project')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->post('/project-manager/create', $clinicCase);

    $response->assertRedirect('/');
    $this->assertDatabaseMissing('projects', $clinicCase);
  }
}
