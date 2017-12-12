<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class CreateRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testCreateRoleFailWithoutLoginUser()
  {
    $role = factory('App\Role')->make()->toArray();
    $response = $this->call('POST', '/project-manager/create', $role, [], [], []);
    $response->assertStatus(302)->assertRedirect('/');
  }

  public function testCreateRoleFailWithoutRequiredParameterAsAdmin()
  {
    $role = factory('App\Role')->make(['project_name' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->post('/project-manager/create', $role);

    $response->assertRedirect('/project-manager/create')
      ->assertSessionHasErrors(['project_name']);
    $this->assertDatabaseMissing('projects', $role);
  }

  public function testCreateRoleSuccessAsAdmin()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $role = factory('App\Role')->make(['image' => $image])->toArray();
    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->post('/project-manager/create', $role);
    $response->assertRedirect('/project-manager')
      ->assertStatus(302);
    $this->assertDatabaseHas('projects', array_splice($role, 0, 1));
  }

  public function testCreateRoleFailLogedAsUser()
  {
    $role = factory('App\Role')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->post('/project-manager/create', $role);

    $response->assertRedirect('/');
    $this->assertDatabaseMissing('projects', $role);
  }
}
