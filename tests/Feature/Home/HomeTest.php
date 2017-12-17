<?php

namespace Tests\Feature\Home;

use Tests\TestCase;

class HomeTest extends TestCase
{
  public function testHome()
  {
    $response = $this->call('GET', '/', [], [], [], []);
    $response->assertSee('Bienvenido')
    ->assertStatus(200);
  }

  public function testMycology()
  {
    $response = $this->call('GET', '/mycology/generalidades', [], [], [], []);
    $response->assertSee('Generalidades')
    ->assertStatus(200);
  }

  public function testLaboratory()
  {
    $response = $this->call('GET', '/lab', [], [], [], []);
    $response->assertSee('Lista de precios')
    ->assertStatus(200);
  }

  public function testProjectsFailWithoutProjectsInDatabase()
  {
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertDontSee('Publicaciones')
    ->assertStatus(200);
  }

  public function testProjectsSuccessWithPublicationsInDatabase()
  {
    $project = factory('App\Project')->create(['project_type' => 'Publicación'])->toArray();
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertSee('Publicaciones')
    ->assertStatus(200);
    $this->assertDatabaseHas('projects', array_splice($project, 0, 1));
  }

  public function testProjectsSuccessWithProjectsInDatabase()
  {
    $project = factory('App\Project')->create(['project_type' => 'Proyecto de investigación'])->toArray();
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertSee('Proyectos')
    ->assertStatus(200);
    $this->assertDatabaseHas('projects', array_splice($project, 0, 1));
  }

  public function testProjectsSuccessWithTFGInDatabase()
  {
    $project = factory('App\Project')->create(['project_type' => 'Trabajo fin grado'])->toArray();
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertSee('Trabajos fin de grado')
    ->assertStatus(200);
    $this->assertDatabaseHas('projects', array_splice($project, 0, 1));
  }

  public function testProjectsSuccessWithTPGInDatabase()
  {
    $project = factory('App\Project')->create(['project_type' => 'Trabajo Post-grado'])->toArray();
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertSee('Trabajos Post')
    ->assertStatus(200);
    $this->assertDatabaseHas('projects', array_splice($project, 0, 1));
  }

  public function testProjectsSuccessWithTesisInDatabase()
  {
    $project = factory('App\Project')->create(['project_type' => 'Tesis'])->toArray();
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertSee('Tesis')
    ->assertStatus(200);
    $this->assertDatabaseHas('projects', array_splice($project, 0, 1));
  }

  public function testContactFormFailWithoutCorrectInput()
  {
    $data = ['name' => 'test', 'email' => 'test', 'subject' => 'test', 'message' => 'test'];
    $response = $this->call('POST', '/contact', $data, [], [], []);
    $response->assertSessionHas('fail')->assertRedirect('/#contact')->assertStatus(302);
  }

  public function testContactFormSuccessWithCorrectInput()
  {
    $data = ['name' => 'test', 'email' => 'test@test.com', 'subject' => 'test', 'message' => 'test'];
    $response = $this->call('POST', '/contact', $data, [], [], []);
    $response->assertSessionHas('suc')->assertRedirect('/#contact')->assertStatus(302);
  }
}
