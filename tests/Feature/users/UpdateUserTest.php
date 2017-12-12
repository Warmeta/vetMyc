<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class UpdateUserTest extends TestCase
{
  // use WithoutMiddleware;

  public function testUpdateUserFailWithoutLoginUser()
  {
    $User = factory('App\User')->create()->toArray();
    $User2 = factory('App\User')->make()->toArray();
    $this->assertDatabaseHas('Users', $User);
    $response = $this->put('/User-manager/' . $User['id'] . '/edit', $User2);
    $response->assertStatus(302)->assertRedirect('/');
    $this->assertDatabaseHas('Users', $User);
  }

  public function testUpdateUserAsAdminSuccess()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $User = factory('App\User')->create()->toArray();
    $User2 = factory('App\User')->make(['User_name' => 'test' ,'image' => $image])->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithAdminPermissions('Users');

    $response = $this
      ->actingAs($user)
      ->put('/User-manager/' . $User['id'] . '/edit', $User2);
    $response->assertStatus(302)->assertRedirect('/User-manager');
    $this->assertDatabaseHas('Users', array_splice($User2, 0, 1));
  }

  public function testUpdateUserFailLogedAsUser()
  {
    $User = factory('App\User')->create()->toArray();
    $User2 = factory('App\User')->make()->toArray();
    $this->assertDatabaseHas('Users', $User);

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->put('/User-manager/' . $User['id'] . '/edit', $User2);
    $response->assertStatus(302)
      ->assertRedirect('/');
    $this->assertDatabaseHas('Users', $User);
  }
}
