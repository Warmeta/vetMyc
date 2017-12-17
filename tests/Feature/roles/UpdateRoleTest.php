<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Role;
use Artisan;

class UpdateRoleTest extends TestCase
{
  public function testUpdateRoleFailWithoutLoginUser()
  {
    $role = $this->createRole('test')->toArray();
    $role2 = Role::firstOrNew(['name' => 'test']);
    if (!$role2->exists) {
        $role2->fill([
                'display_name' => 'test',
            ]);
    }
    $role2 = $role2->toArray();
    $this->assertDatabaseHas('roles', $role);
    $response = $this->put('/admin/roles/' . $role['id'], $role2);
    $response->assertStatus(302)->assertRedirect('/admin/login');
    $this->assertDatabaseHas('roles', $role);
  }

  public function testUpdateRoleAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $role = $this->createRole('test')->toArray();
    $role2 = Role::firstOrNew(['name' => 'test']);
    if (!$role2->exists) {
        $role2->fill([
                'display_name' => 'test',
            ]);
    }
    $role2 = $role2->toArray();
    $this->assertDatabaseHas('roles', $role);

    $user = $this->createUserWithAdminPermissions('roles');

    $response = $this
      ->actingAs($user)
      ->put('/admin/roles/' . $role['id'], $role2);
    $response->assertStatus(302)->assertRedirect('/admin/roles');
    $this->assertDatabaseHas('roles', array_splice($role2, 0, 1));
  }

  public function testUpdateRoleFailLogedAsUser()
  {
    $role = $this->createRole('test')->toArray();
    $role2 = Role::firstOrNew(['name' => 'test']);
    if (!$role2->exists) {
        $role2->fill([
                'display_name' => 'test',
            ]);
    }
    $role2 = $role2->toArray();
    $this->assertDatabaseHas('roles', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->put('/admin/roles/' . $role['id'], $role2);
    $response->assertStatus(302)
      ->assertRedirect('/');
    $this->assertDatabaseHas('roles', $role);
  }
}
