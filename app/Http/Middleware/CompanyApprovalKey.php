<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyApprovalKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->query('api_key');
        $user = Auth::user();

        if (!$user || $apiKey !== $user->remember_token) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
