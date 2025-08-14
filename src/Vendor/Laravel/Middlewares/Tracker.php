<?php

namespace PragmaRX\Tracker\Vendor\Laravel\Middlewares;

use Closure;
use Config;

class Tracker
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Config::get('tracker.enabled')) {
            $user = auth()->user();
            // Nếu chưa login hoặc không phải admin thì boot Tracker
            if (!$user) {
                app('tracker')->boot();
            }
        }

        return $next($request);
    }
}
