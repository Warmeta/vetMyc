<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UpdateRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testUpdateRoleFailWithoutLoginUser()
  {
    $role = factory('App\Role')->create()->toArray();
    $role2 = factory('App\Role')->make()->toArray();
    $this->assertDatabaseHas('projects', $role);
    $response = $this->put('/project-manager/' . $role['id'] . '/edit', $role2);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('projects', $role);
  }

  public function testUpdateRoleAsAdminSuccess()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $role = factory('App\Role')->create()->toArray();
    $role2 = factory('App\Role')->make(['project_name' => 'test' ,'image' => $image])->toArray();
    $this->assertDatabaseHas('projects', $role);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->put('/project-manager/' . $role['id'] . '/edit', $role2);
    $response->assertStatus(302)->assertRedirect('/project-manager');
    $this->assertDatabaseHas('projects', array_splice($role2, 0, 1));
  }

  public function testUpdateRoleFailLogedAsUser()
  {
    $role = factory('App\Role')->create()->toArray();
    $role2 = factory('App\Role')->make()->toArray();
    $this->assertDatabaseHas('projects', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->put('/project-manager/' . $role['id'] . '/edit', $role2);
    $response->assertStatus(302)
      ->assertRedirect('/');
    $this->assertDatabaseHas('projects', $role);
  }
}
