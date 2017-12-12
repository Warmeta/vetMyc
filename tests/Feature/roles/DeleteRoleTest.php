<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class DeleteRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testDeleteRoleFailWithoutLoginUser()
  {
    $role = factory('App\Role')->create()->toArray();
    $this->assertDatabaseHas('projects', $role);
    $response = $this->delete('/project-manager/delete/' . $role['id']);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('projects', $role);
  }

  public function testDeleteRoleAsAdminSuccess()
  {
    $role = factory('App\Role')->create()->toArray();
    $this->assertDatabaseHas('projects', $role);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->delete('/project-manager/delete/' . $role['id']);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('projects', $role);
  }

  public function testDeleteRoleFailLogedAsUser()
  {
    $role = factory('App\Role')->create()->toArray();
    $this->assertDatabaseHas('projects', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/project-manager/delete/' . $role['id']);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('projects', $role);
  }
}
