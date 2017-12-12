<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class DeleteUserTest extends TestCase
{
  // use WithoutMiddleware;

  public function testDeleteUserFailWithoutLoginUser()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);
    $response = $this->delete('/User-manager/delete/' . $User['id']);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('Users', $User);
  }

  public function testDeleteUserAsAdminSuccess()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithAdminPermissions('Users');

    $response = $this
      ->actingAs($user)
      ->delete('/User-manager/delete/' . $User['id']);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('Users', $User);
  }

  public function testDeleteUserFailLogedAsUser()
  {
    $User = factory('App\User')->create()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->delete('/User-manager/delete/' . $User['id']);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('Users', $User);
  }
}
