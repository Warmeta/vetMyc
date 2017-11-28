<?php

namespace Tests\Feature\Home;

use Tests\TestCase;

class HomeTest extends TestCase
{
  public function testHome()
  {
    $response = $this->call('GET', '/', [], [], [], []);
    $response->assertSee('Bienvenido');
  }

  public function testMycology()
  {
    $response = $this->call('GET', '/mycology/generalidades', [], [], [], []);
    $response->assertSee('Generalidades');
  }

  public function testLaboratory()
  {
    $response = $this->call('GET', '/lab', [], [], [], []);
    $response->assertSee('Lista de precios');
  }

  public function testProjects()
  {
    $response = $this->call('GET', '/projects', [], [], [], []);
    $response->assertSee('Proyectos');
  }

  public function testPublications()
  {
    $response = $this->call('GET', '/publications', [], [], [], []);
    $response->assertSee('Publicaciones');
  }
}
