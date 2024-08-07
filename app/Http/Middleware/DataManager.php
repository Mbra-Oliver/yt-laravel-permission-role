<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DataManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

      public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (Auth::check() && $this->userHasAnyPermission($permissions)) {
       
            return $next($request);
        }

        return redirect()->back()->with('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
    }

    /**
     * Check if the authenticated user has at least one of the specified permissions.
     *
     * @param  array  $permissions
     * @return bool
     */
    protected function userHasAnyPermission(array $permissions)
    {
        foreach ($permissions as $permission) {
            if (Auth::user()->can($permission)) {
                return true;
            }
        }

        return false;
    }

}
