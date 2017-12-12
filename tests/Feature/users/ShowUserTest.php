<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class ShowUserTest extends TestCase
{
  // use WithoutMiddleware;

  public function testShowUserAsUserSuccess()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $response = $this->get('/User-manager/' . $User['id']);
    $response->assertStatus(200)->assertSee((string)$User['User_name']);
  }

  public function testShowUserAsAdminSuccess()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithAdminPermissions('Users');

    $response = $this
      ->actingAs($user)
      ->get('/User-manager/' . $User['id']);
    $response->assertStatus(200)->assertSee((string)$User['User_name']);
  }

  public function testShowUserFailLogedAsUser()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->get('/User-manager/' . $User['id']);
    $response->assertStatus(200)->assertSee((string)$User['User_name']);
  }
}
