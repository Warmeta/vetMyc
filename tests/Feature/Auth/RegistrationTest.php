<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
  public function testRegistrationErrorPassword()
  {
    $credentials = ['name' => 'test', 'email' => 'test@test.com', 'password' => 'invalid', 'password_confirmation' => 'invalid1'];
    $response = $this->call('POST', '/register', $credentials, [], [], []);
    $response->assertSessionHasErrors();
    $response->assertRedirect('/');
  }

  public function testRegistrationErrorEmail()
  {
    $credentials = ['name' => 'test', 'email' => 'testtest.com', 'password' => 'invalid', 'password_confirmation' => 'invalid'];
    $response = $this->call('POST', '/register', $credentials, [], [], []);
    $response->assertSessionHasErrors();
    $response->assertRedirect('/');
  }
  
  public function testRegistrationSuccess()
  {
    $credentials = ['name' => 'test', 'email' => 'test@test.com', 'password' => 'invalid', 'password_confirmation' => 'invalid'];
    $response = $this->call('POST', '/register', $credentials, [], [], []);
    $response->assertRedirect('/');
  }
}
