<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use App\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    //use DatabaseMigrations;
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($user = User::where('name', 'Admin')->firstOrFail())
                ->assertPathIs('/_dusk/login/'.$user->id);
        });
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($user = $this->adminUser())
                ->assertPathIs('/_dusk/login/'.$user->id);
        });
    }
}
