<?php

namespace App\Http\Middleware;

use App\Enums\IsDeleted;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStaffExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $staff = $request->route('staff');

        if ($staff->is_deleted === IsDeleted::YES->value) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
