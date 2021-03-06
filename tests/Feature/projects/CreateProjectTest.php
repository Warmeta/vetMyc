<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class CreateProjectTest extends TestCase
{
  public function testCreateProjectFailWithoutLoginUser()
  {
    $project = factory('App\Project')->make()->toArray();
    $response = $this->call('POST', '/project-manager/create', $project, [], [], []);
    $response->assertStatus(302)->assertRedirect('/');
  }

  public function testCreateProjectFailWithoutRequiredParameterAsAdmin()
  {
    $project = factory('App\Project')->make(['project_name' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
    ->actingAs($user)
    ->post('/project-manager/create', $project);

    $response->assertRedirect('/project-manager/create')
    ->assertStatus(302)
    ->assertSessionHasErrors(['project_name']);
    $this->assertDatabaseMissing('projects', $project);
  }

  public function testCreateProjectSuccessAsAdmin()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $project = factory('App\Project')->make(['image' => $image])->toArray();
    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
    ->actingAs($user)
    ->post('/project-manager/create', $project);
    $response->assertRedirect('/project-manager')
    ->assertStatus(302);
    $this->assertDatabaseHas('projects', array_splice($project, 0, 1));
  }

  public function testCreateProjectFailLogedAsUser()
  {
    $project = factory('App\Project')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
    ->actingAs($user)
    ->post('/project-manager/create', $project);

    $response->assertRedirect('/')
    ->assertStatus(302);
    $this->assertDatabaseMissing('projects', $project);
  }
}
