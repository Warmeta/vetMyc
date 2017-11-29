<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    // use DatabaseMigrations;

    public function createUserWithAdminPermissions(string $table)
    {
      $role = $this->createRole('admin');
      $this->createRole('user');

      $this->createPermissions($table, $role);

      $user = $this->createUser($role->id);

      return $user;
    }

    public function createUserWithUserPermissions()
    {
      $this->createRole('admin');
      $role = $this->createRole('user');

      $user = $this->createUser($role->id);

      return $user;
    }

    public function createRole(string $role_name)
    {
      $role = Role::firstOrNew(['name' => $role_name]);

      if (!$role->exists) {
          $role->fill([
                  'display_name' => $role_name,
              ])->save();
      }

      $role = Role::where('name', $role_name)->firstOrFail();

      return $role;
    }

    public function createPermissions(string $table,Role $role)
    {
      Permission::generateFor($table);

      $permissions = Permission::all();

      $role->permissions()->sync(
          $permissions->pluck('id')->all()
      );
    }

    public function createUser(int $id)
    {
      $user = User::create([
          'name'           => 'Test',
          'email'          => 'test@test.com',
          'password'       => bcrypt('password'),
          'remember_token' => str_random(60),
          'role_id'        => $id,
      ]);

      return $user;
    }

}
