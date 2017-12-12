<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class ShowRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testShowRoleAsUserSuccess()
  {
    $role = factory('App\Role')->create()->toArray();
    $this->assertDatabaseHas('projects', $role);

    $response = $this->get('/project-manager/' . $role['id']);
    $response->assertStatus(200)->assertSee((string)$role['project_name']);
  }

  public function testShowRoleAsAdminSuccess()
  {
    $role = factory('App\Role')->create()->toArray();
    $this->assertDatabaseHas('projects', $role);

    $user = $this->createUserWithAdminPermissions('projects');

    $response = $this
      ->actingAs($user)
      ->get('/project-manager/' . $role['id']);
    $response->assertStatus(200)->assertSee((string)$role['project_name']);
  }

  public function testShowRoleFailLogedAsUser()
  {
    $role = factory('App\Role')->create()->toArray();
    $this->assertDatabaseHas('projects', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/project-manager/' . $role['id']);
    $response->assertStatus(200)->assertSee((string)$role['project_name']);
  }
}
