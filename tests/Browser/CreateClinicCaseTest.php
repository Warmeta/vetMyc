<?php

namespace Tests\Browser;

use App\ClinicCase;
use Illuminate\Support\Facades\Auth;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateClinicCaseTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    //use DatabaseMigrations;
    protected $number = '12';
    protected $text = 'This is a text';

    public function test_user_cant_create_a_clinic_case()
    {
        $user = $this->defaultUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('clinicCase.create')
                // Test a user is redirected to the / path, cant create the clinic case.
                ->assertPathIs('/');
        });
    }

    public function test_admin_can_create_a_clinic_case()
    {
        $user = $this->adminUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('clinicCase.create')
                ->assertPathIs('/lab/clinic-case/create')
                ->type('number_clinic_history', $this->number)
                ->type('ref_animal', $this->number)
                ->type('specie', $this->text)
                ->type('clinic_history', $this->text)
                ->type('owner', $this->text)
                ->type('breed', $this->text)
                ->select('sex', 'male')
                ->type('age', $this->number)
                ->select('localization', 'eye')
                ->select('clinic_case_status', 'inprogress');
            $browser->driver->executeScript('window.scrollTo(0, 800);');
            $browser->press('Create')
                // Test a user is redirected to the lab index.
                ->assertPathIs('/lab/clinic-case');
        });
        // Then
        $this->assertDatabaseHas('clinic_cases', [
            'number_clinic_history' => $this->number,
            'author_id' => $user->id,
            'ref_animal' => $this->number,
            'specie' => $this->text,
            'clinic_history' => $this->text,
            'owner' => $this->text,
            'breed' => $this->text,
            'sex' => 'male',
            'age' => $this->number,
            'localization' => 'eye',
            'clinic_case_status' => 'inprogress',
        ]);
    }

    public function test_clinic_case_form_validation()
    {
        $user = $this->adminUser();
        $this->browse(function ($browser) use ($user) {
            // Having
            $browser->loginAs($user)
                ->visitRoute('clinicCase.create')
                ->driver->executeScript('window.scrollTo(0, 800);');
            $browser->press('Create')
                // Then
                ->assertPathIs('/lab/clinic-case/create')
                ->assertSeeIn('#errors1', 'field is required.')
                ->assertSeeIn('#errors2', 'field is required.')
                ->assertSeeIn('#errors3', 'field is required.')
                ->assertSeeIn('#errors4', 'field is required.')
                ->assertSeeIn('#errors5', 'field is required.')
                ->assertSeeIn('#errors6', 'field is required.')
                ->assertSeeIn('#errors7', 'field is required.')
                ->assertSeeIn('#errors8', 'field is required.')
                ->assertSeeIn('#errors9', 'field is required.');
        });
    }
    /*
     * // Then
        $this->assertDatabaseHas('posts', [
            'title' => $this->title,
            'content' => $this->content,
            'pending' => true,
            'user_id' => $user->id,
            'slug' => 'esta-es-una-pregunta',
        ]);
        $post = Post::first();
        // Test the author is suscribed automatically to the post.
        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
    function test_creating_a_post_requires_authentication()
    {
        $this->browse(function ($browser) {
            $browser->visitRoute('posts.create')
                ->assertRouteIs('token');
        });
    }
    function test_create_post_form_validation()
    {
        $this->browse(function ($browser) {
            $browser->loginAs($this->defaultUser())
                ->visitRoute('posts.create')
                ->press('Publicar')
                ->assertRouteIs('posts.create')
                ->assertSeeErrors([
                    'title' => 'El campo título es obligatorio',
                    'content' => 'El campo contenido es obligatorio'
                ]);
        });
    }*/
}
