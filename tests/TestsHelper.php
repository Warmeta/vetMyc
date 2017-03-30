<?php
/**
 * Created by PhpStorm.
 * User: Jose
 * Date: 19/03/2017
 * Time: 0:50
 */
namespace Tests;

use App\User;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\VoyagerUser;


trait TestsHelper
{
    protected $dUser;

    public function defaultUser()
    {
        if ($this->dUser){
            return $this->dUser;
        }
        return $this->dUser = factory(User::class)->create();
    }

    public function adminUser()
    {
        if ($this->dUser){
            return $this->dUser;
        }
        $user = factory(User::class)->create();
        $user->role_id = '1';
        $user->save();
        return $user;
    }
}