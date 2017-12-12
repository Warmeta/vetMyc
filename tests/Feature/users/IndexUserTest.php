<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Artisan;

class IndexUserTest extends TestCase
{
  // use WithoutMiddleware;

  public function testIndexUserFailWithoutLoginUser()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);
    $response = $this->get('/User-manager');
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('Users', $User);
  }

  public function testIndexUserAsAdminSuccess()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithAdminPermissions('Users');

    $response = $this
      ->actingAs($user)
      ->get('/User-manager');
    $response->assertStatus(200)
      ->assertSee((string)$User['User_name']);
  }

  public function testIndexUserFailLogedAsUser()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/User-manager');
    $response->assertStatus(302)
      ->assertRedirect('/');
  }
}
