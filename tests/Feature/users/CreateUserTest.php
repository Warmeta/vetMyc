<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use TCG\Voyager\Models\User;
use TCG\Voyager\Models\Role;
use Artisan;

class CreateUserTest extends TestCase
{
  public function testCreateUserFailWithoutLoginUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->make()->toArray();
    $response = $this->call('POST', '/admin/users', $u, [], [], []);
    $response->assertStatus(302);
    $this->assertDatabaseMissing('users', $u);
  }

  public function testCreateUserSuccessAsAdmin()
  {
    $user = $this->createUserWithAdminPermissions('users');
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $role = Role::where('name', 'admin')->firstOrFail();
    $u = factory('TCG\Voyager\Models\User')->make(['password' => 'secret'])->toArray();

    $response = $this
    ->actingAs($user)
    ->post('/admin/users', $u);

    $u = User::where(['name' => $u['name']])->first()->toArray();
    $response->assertRedirect('/admin/users/'.$u['id'].'/edit')
    ->assertStatus(302);
    $this->assertDatabaseHas('users', array_splice($u, 0, 1));
  }

  public function testCreateUserFailLogedAsUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
    ->actingAs($user)
    ->post('/admin/users', $u);

    $response->assertRedirect('/');
    $this->assertDatabaseMissing('users', $u);
  }
}
