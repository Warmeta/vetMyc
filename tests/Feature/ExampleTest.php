<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Jose Garcia',
        ]);

        $this->actingAs($user, 'web')
            ->visitRoute('api/user')
            ->see('Jose Garcia');

    }
}
