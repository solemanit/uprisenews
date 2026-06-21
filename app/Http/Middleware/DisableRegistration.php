<?php

// app/Http/Middleware/DisableRegistration.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableRegistration
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('register', 'register/*')) {
            abort(404);
        }

        return $next($request);
    }
}
