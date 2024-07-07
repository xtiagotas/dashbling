<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function Ramsey\Uuid\v1;

class SubscriptionActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user->isPeriodTest()) {
            return $next($request);
        }

        if ($user->hasSubscription()) {
            if ($user->hasSubscriptionValid()) {
                return $next($request);
            }
            return redirect()->route('settings.edit');
        }
        
        return redirect()->route('subscribe');
    }
}
