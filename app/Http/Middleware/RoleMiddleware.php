<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private const ROLE_MAP = [
          0 => 'user',
          1 => 'seller',
          2 => 'salesSpecialist',
          3 => 'contentSpecialist',
          4 => 'superAdmin',
          5 => 'owner'
    ];
    public function handle(Request $request, Closure $next, $roles): Response
    {
        try {
        

        $userRoleId = session('role');

        $userRole = self::ROLE_MAP[$userRoleId] ?? null;

        if(!in_array($userRole, explode('|', $roles))){
            return response()->json([], 403);
        }

        return $next($request);
        } catch(\Exception $e){
            return response()->json([], 401);
        }
    }
}
