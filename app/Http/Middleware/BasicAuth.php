<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request Request.
     * @param Closure $next Next.
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If environment is local | production, return next request
        if (config('app.env') === 'local' || config('app.env') === 'production') {
            return $next($request);
        }
        // Basic auth
        $authUser = config('basic-auth.username');
        $authPass = config('basic-auth.password');
        if (! $request->hasHeader('authorization') ||
            ($request->header('authorization') !== strtr(
                'Basic :base64code',
                [':base64code' => base64_encode($authUser. ':' . $authPass)]
            ))) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }

        return $next($request);
    }
}
