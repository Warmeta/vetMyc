<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use Artisan;

class IndexRoleTest extends TestCase
{
  // use WithoutMiddleware;

  public function testIndexRoleFailWithoutLoginUser()
  {
    $user = $this->createUserWithAdminPermissions('roles');
    $role = $this->createRole('test')->toArray();
    $this->assertDatabaseHas('roles', $role);
    $response = $this->get('/admin/roles');
    $response->assertStatus(302)->assertRedirect('/admin/login');
    $this->assertDatabaseHas('roles', $role);
  }

  public function testIndexRoleAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $user = $this->createUserWithAdminPermissions('roles');

    $role = $this->createRole('test')->toArray();
    $this->assertDatabaseHas('roles', $role);
    $response = $this
      ->actingAs($user)
      ->get('/admin/roles');
    $response->assertStatus(200)
      ->assertSee((string)$role['name']);
  }

  public function testIndexRoleFailLogedAsUser()
  {
    $role = $this->createRole('test')->toArray();
    $this->assertDatabaseHas('roles', $role);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/admin/roles');
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
