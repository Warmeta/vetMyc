<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use TCG\Voyager\Models\User;
use Artisan;

class IndexUserTest extends TestCase
{
  public function testIndexUserFailWithoutLoginUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);
    $response = $this->call('GET', '/admin/users/');
    $response->assertStatus(302)->assertRedirect('/admin/login');
    $this->assertDatabaseHas('users', $u);
  }

  public function testIndexUserAsAdminSuccess()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $user = $this->createUserWithAdminPermissions('users');

    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);
    $response = $this
      ->actingAs($user)
      ->get('/admin/users');
    $response->assertStatus(200)
      ->assertSee((string)$u['name']);
  }

  public function testIndexUserFailLogedAsUser()
  {
    Artisan::call('db:seed', ['--database' => 'sqlite']);
    $u = factory('TCG\Voyager\Models\User')->create()->toArray();
    $this->assertDatabaseHas('users', $u);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/admin/users');
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
