<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LeadAuditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->LA) {
            abort(403, 'No rights to access here.');
        }
        return $next($request);
    }
}
