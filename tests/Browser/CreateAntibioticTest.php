<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateAntibioticTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    protected $text = 'This is a text';

    public function test_user_cant_create_antibiotic()
    {
        $user = $this->defaultUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('antibiotic.create')
                // Test a user is redirected to the / path, cant create the clinic case.
                ->assertPathIs('/');
        });
    }

    public function test_admin_can_create_antibiotic()
    {
        $user = $this->adminUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('antibiotic.create')
                ->assertPathIs('/lab/antibiotic/create')
                ->type('antibiotic_name', $this->text)
                ->type('description', $this->text);
            $browser->press('Create')
                // Test a user is redirected to the lab index.
                ->assertPathIs('/lab/antibiotic');
        });
        // Then
        $this->assertDatabaseHas('antibiotics', [
            'antibiotic_name' => $this->text,
            'description' => $this->text,
        ]);
    }

    public function test_antibiotic_form_validation()
    {
        $user = $this->adminUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('antibiotic.create');
            $browser->press('Create')
                // Then
                ->assertPathIs('/lab/antibiotic/create')
                ->assertSeeIn('#errors1', 'field is required.')
                ->assertSeeIn('#errors2', 'field is required.');
        });
    }
}
