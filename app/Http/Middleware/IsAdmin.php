<?php

namespace App\Http\Middleware;

use App\Constants\Roles;
use Closure;
use Illuminate\Validation\UnauthorizedException;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private function checkRole($roles, $role)
    {
        foreach ($roles as $r) {
            if ($r->id == $role) {
                return true;
            }
        }
        return false;
    }

    public function handle($request, Closure $next)
    {
        if ($this->checkRole($request->user()->roles, Roles::ADMIN))
            return $next($request);

        throw new UnauthorizedException("Not Allowed Action");
    }
}
