<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;
use \Illuminate\Http\Request;

class UserPermissionsMiddleware
{
    private $requiredRoles = [];

    private $requiredPermissions = [];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user->hasRole('manager')){
            if ($request->is('*/company/*/edit')){
                $urlInfo = explode('/', $request->path());
                $company_id = $urlInfo[2];
                if(!$user->canEditCompany($company_id)){
                    throw UnauthorizedException::forRoles(['manager']);
                    return $exception;
                }

            }
        }
        return $next($request);
    }
}
