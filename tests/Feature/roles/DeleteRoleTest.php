<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use Artisan;

class DeleteRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testDeleteRoleFailWithoutLoginUser()
  {
    $user = $this->createUserWithAdminPermissions('roles');
    $role = $this->createRole('test')->toArray();
    $this->assertDatabaseHas('roles', $role);
    $response = $this->delete('/admin/roles/' . $role['id']);
    $response->assertStatus(302)->assertRedirect('/admin/login');
    $this->assertDatabaseHas('roles', $role);
  }

  public function testDeleteRoleAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $user = $this->createUserWithAdminPermissions('roles');

    $role = $this->createRole('test')->toArray();

    $response = $this
      ->actingAs($user)
      ->delete('/admin/roles/' . $role['id']);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('roles', $role);
  }

  public function testDeleteRoleFailLogedAsUser()
  {
    $role = $this->createRole('test')->toArray();
    $this->assertDatabaseHas('roles', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/admin/roles/' . $role['id']);
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
