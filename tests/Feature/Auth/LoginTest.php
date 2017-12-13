<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class LoginTest extends TestCase
{
  public function testLoginError()
  {
    $user = factory('App\User')->create();
    $credentials = ['email' => $user->email, 'password' => 'invalid'];
    $response = $this->call('POST', '/login', $credentials, [], [], []);
    $response->assertSessionHasErrors();
    $response->assertRedirect('/');
  }

  public function testLoginSuccess()
  {
    $user = factory('App\User')->create();
    $credentials = ['email' => $user->email, 'password' => 'secret'];
    $response = $this->call('POST', '/login', $credentials, [], [], []);
    $response->assertRedirect('/');
  }
}
