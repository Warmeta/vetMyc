<?php

/**
 * Created by PhpStorm.
 * User: Jose
 * Date: 23/03/2017
 * Time: 4:07
 */



if (! function_exists('hasPermission')) {

    /**
     * Created by PhpStorm.
     * User: Jose
     * Date: 23/03/2017
     * Time: 3:44
     */
    function hasPermission(string $permission)
    {
        $load = TCG\Voyager\Models\Permission::all();
        // Check if permission exist
        if (!Illuminate\Support\Facades\Auth::guest()) {
            if ($load) {
                $id = Illuminate\Support\Facades\Auth::user()->id;
                $role = Illuminate\Support\Facades\DB::table('users')->where('id', $id)->pluck('role_id');
                $perm = TCG\Voyager\Models\Permission::where('key', $permission)->pluck('id');
                if ($role->contains('1')) {
                    return true;
                } elseif ((!$perm->isEmpty()) && (!$role->isEmpty())) {
                    $result = Illuminate\Support\Facades\DB::table('permission_role')
                        ->where([
                            ['permission_id', $perm],
                            ['role_id', $role]
                        ])->get();
                    if (!$result->isEmpty()) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}