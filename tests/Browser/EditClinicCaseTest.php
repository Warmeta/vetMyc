<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditClinicCaseTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    protected $number = '12';
    protected $text = 'This is a text edited';
    protected $wrongtext = 'this is a wrong textthis is a wrong textthis is a wrong textthis is a wrong textt
    this is a wrong textthis is a wrong textthis is a wrong textthis is a wrong tex';

    public function test_user_cant_edit_a_clinic_case()
    {
        $user = $this->defaultUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('clinicCase.index')
                // Test a user is redirected to the / path, cant create the clinic case.
                ->assertPathIs('/');
        });
    }

    public function test_admin_can_edit_a_clinic_case()
    {
        $user = $this->adminUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('clinicCase.index')
                ->click('.edit')
                ->type('ref_animal', $this->number)
                ->type('specie', $this->text)
                ->type('owner', $this->text)
                ->select('sex', 'male')
                ->type('age', $this->number);
            $browser->driver->executeScript('window.scrollTo(0, 800);');
            $browser->press('Edit')
                // Test a user is redirected to the lab index.
                ->assertPathIs('/lab/clinic-case');
        });
        // Then
        $this->assertDatabaseHas('clinic_cases', [
            'ref_animal' => $this->number,
            'specie' => $this->text,
            'owner', $this->text,
            'sex', 'male',
            'age', $this->number,
        ]);
    }

    public function test_clinic_case_form_edit_validation()
    {
        $user = $this->adminUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('clinicCase.index')
                ->click('.edit')
                ->type('age', $this->wrongtext)
                ->type('specie', $this->wrongtext)
                ->driver->executeScript('window.scrollTo(0, 800);');
                $browser->press('Edit')
                // Then
                ->assertSeeIn('#errors3', 'may not be greater than 30 characters.')
                ->assertSeeIn('#errors8', 'must be a number.');
        });
    }
}
