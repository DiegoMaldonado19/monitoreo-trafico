<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user || $user->rol->nombre_rol !== $role) {
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta sección.']);
        }

        return $next($request);
    }
}
