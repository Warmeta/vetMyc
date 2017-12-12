<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class CreateUserTest extends TestCase
{
  // use WithoutMiddleware;

  public function testCreateUserFailWithoutLoginUser()
  {
    $User = factory('App\User')->make()->toArray();
    $response = $this->call('POST', '/User-manager/create', $User, [], [], []);
    $response->assertStatus(302)->assertRedirect('/');
  }

  public function testCreateUserFailWithoutRequiredParameterAsAdmin()
  {
    $User = factory('App\User')->make(['User_name' => ''])->toArray();

    $user = $this->createUserWithAdminPermissions('Users');

    $response = $this
      ->actingAs($user)
      ->post('/User-manager/create', $User);

    $response->assertRedirect('/User-manager/create')
      ->assertSessionHasErrors(['User_name']);
    $this->assertDatabaseMissing('Users', $User);
  }

  public function testCreateUserSuccessAsAdmin()
  {
    $image = \Illuminate\Http\UploadedFile::fake()->create('image.png', $kilobytes = 1);
    $User = factory('App\User')->make(['image' => $image])->toArray();
    $user = $this->createUserWithAdminPermissions('Users');

    $response = $this
      ->actingAs($user)
      ->post('/User-manager/create', $User);
    $response->assertRedirect('/User-manager')
      ->assertStatus(302);
    $this->assertDatabaseHas('Users', array_splice($User, 0, 1));
  }

  public function testCreateUserFailLogedAsUser()
  {
    $User = factory('App\User')->make()->toArray();

    $user = $this->createUserWithUserPermissions();

    $response = $this
      ->actingAs($user)
      ->post('/User-manager/create', $User);

    $response->assertRedirect('/');
    $this->assertDatabaseMissing('Users', $User);
  }
}
