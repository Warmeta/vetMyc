<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use Artisan;

class CreateRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testCreateRoleFailWithoutLoginUser()
  {
    $role = Role::firstOrNew(['name' => 'test']);
    if (!$role->exists) {
        $role->fill([
                'display_name' => 'test',
            ]);
    }
    $response = $this->call('POST', '/admin/roles', $role->toArray(), [], [], []);
    $response->assertStatus(302)->assertRedirect('/admin/login');
    $this->assertDatabaseMissing('roles', $role->toArray());
  }

  public function testCreateRoleSuccessAsAdmin()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $role = Role::firstOrNew(['name' => 'test']);
    if (!$role->exists) {
        $role->fill([
                'display_name' => 'test',
            ]);
    }
    $role = $role->toArray();
    $user = $this->createUserWithAdminPermissions('roles');

    $response = $this
      ->actingAs($user)
      ->post('/admin/roles', $role);
    $response->assertRedirect('/admin/roles')
      ->assertStatus(302);
    $this->assertDatabaseHas('roles', array_splice($role, 0, 1));
  }

  public function testCreateRoleFailLogedAsUser()
  {
    $role = Role::firstOrNew(['name' => 'test']);
    if (!$role->exists) {
        $role->fill([
                'display_name' => 'test',
            ]);
    }

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->post('/admin/roles', $role->toArray());

    $response->assertRedirect('/');
    $this->assertDatabaseMissing('roles', $role->toArray());
  }
}
