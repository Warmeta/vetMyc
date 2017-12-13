<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use Artisan;

class ShowUserTest extends TestCase
{
  // use WithoutMiddleware;

  public function testShowUserAsUserFail()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);

    $response = $this->get('/admin/users/' . $u['id']);
    $response->assertStatus(302)->assertRedirect('/admin/login');
  }

  public function testShowUserAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);

    $user = $this->createUserWithAdminPermissions('users');

    $response = $this
      ->actingAs($user)
      ->get('/admin/users/' . $u['id']);
    $response->assertStatus(200)->assertSee((string)$u['name']);
  }

  public function testShowUserFailLogedAsUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/admin/users/' . $u['id']);
    $response->assertStatus(302)->assertRedirect('/');
  }
}
