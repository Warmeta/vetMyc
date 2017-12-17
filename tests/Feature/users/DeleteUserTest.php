<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use TCG\Voyager\Models\User;
use Artisan;

class DeleteUserTest extends TestCase
{
  public function testDeleteUserFailWithoutLoginUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);
    $response = $this->call('DELETE', '/admin/users/' . $u['id']);
    $response->assertStatus(302);
    $this->assertDatabaseHas('users', $u);
  }

  public function testDeleteUserAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $user = $this->createUserWithAdminPermissions('users');

    $u = factory('TCG\Voyager\Models\User')->create()->toArray();

    $response = $this
      ->actingAs($user)
      ->delete('/admin/users/' . $u['id']);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('users', $u);
  }

  public function testDeleteUserFailLogedAsUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/admin/users/' . $u['id']);
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
