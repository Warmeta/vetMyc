<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Role;
use Artisan;

class ShowRoleTest extends TestCase
{
  public function testShowRoleAsUserSuccess()
  {
    $role = Role::firstOrNew(['name' => 'test']);
    if (!$role->exists) {
        $role->fill([
                'display_name' => 'test',
            ])->save();
    }
    $role = $role->toArray();
    $this->assertDatabaseHas('roles', $role);

    $response = $this->get('/admin/roles/' . $role['id']);
    $response->assertStatus(302)->assertRedirect('/admin/login');
  }

  public function testShowRoleAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $role = Role::firstOrNew(['name' => 'test']);
    if (!$role->exists) {
        $role->fill([
                'display_name' => 'test',
            ])->save();
    }
    $role = $role->toArray();
    $this->assertDatabaseHas('roles', $role);

    $user = $this->createUserWithAdminPermissions('roles');

    $response = $this
      ->actingAs($user)
      ->get('/admin/roles/' . $role['id']);
    $response->assertStatus(200)->assertSee((string)$role['name']);
  }

  public function testShowRoleFailLogedAsUser()
  {
    $role = Role::firstOrNew(['name' => 'test']);
    if (!$role->exists) {
        $role->fill([
                'display_name' => 'test',
            ])->save();
    }
    $role = $role->toArray();
    $this->assertDatabaseHas('roles', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/admin/roles/' . $role['id']);
    $response->assertStatus(302)->assertRedirect('/');
  }
}
