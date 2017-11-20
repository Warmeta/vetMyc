<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
      $credentials = ['user' => 'admin@admin.com', 'password' => 'password'];
      $response = $this->call('POST', '/login', $credentials, [], [], []);

      $response->assertRedirect('/');
    }
}
