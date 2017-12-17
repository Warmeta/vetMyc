<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use TCG\Voyager\Models\User;
use Artisan;

class UpdateUserTest extends TestCase
{
  public function testUpdateUserFailWithoutLoginUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $u2 = factory('TCG\Voyager\Models\User')->make()->toArray();
    $this->assertDatabaseHas('users', $u);
    $response = $this->put('/admin/users/' . $u['id'], $u2);
    $response->assertStatus(302)->assertRedirect('/admin/login');
    $this->assertDatabaseHas('users', $u);
  }

  public function testUpdateUserAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $u2 = User::firstOrNew(['name' => 'test']);
    $u2 = factory('TCG\Voyager\Models\User')->make()->toArray();
    $this->assertDatabaseHas('users', $u);

    $user = $this->createUserWithAdminPermissions('users');

    $response = $this
      ->actingAs($user)
      ->put('/admin/users/' . $u['id'], $u2);
    $response->assertStatus(302)->assertRedirect('/admin/users/'.$u['id'].'/edit');
    $this->assertDatabaseHas('users', array_splice($u2, 0, 1));
  }

  public function testUpdateUserFailLogedAsUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $u2 = User::firstOrNew(['name' => 'test']);
    $u2 = factory('TCG\Voyager\Models\User')->make()->toArray();
    $this->assertDatabaseHas('users', $u);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->put('/admin/users/' . $u['id'], $u2);
    $response->assertStatus(302)
      ->assertRedirect('/');
    $this->assertDatabaseHas('users', $u);
  }
}
