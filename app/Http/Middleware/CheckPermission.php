<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Permission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $load = Permission::all();
        // Check if permission exist
        if (!Auth::guest()) {
            if ($load) {
                $id = Auth::user()->id;
                $role = DB::table('users')->where('id', $id)->pluck('role_id');
                $perm = Permission::where('key', $permission)->pluck('id');
                if ($role->contains('1')){
                    return $next($request);
                }elseif ((!$perm->isEmpty()) && (!$role->isEmpty())) {
                $result = DB::table('permission_role')
                    ->where([
                        ['permission_id', $perm],
                        ['role_id', $role]
                    ])->get();
                    if (!$result->isEmpty()) {
                        return $next($request);
                    }
                }
            }
        }
        return redirect('/');
    }
}
