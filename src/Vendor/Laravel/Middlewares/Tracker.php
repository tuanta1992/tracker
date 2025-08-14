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
            // Nếu không phải là admin thì boot Tracker
            $user = auth()->user();

            // Kiểm tra URL đã được log trong session chưa
            $session = app('tracker')->currentSession();
            $currentUrl = $request->path();
            $loggedUrls = $session->pageViews()->pluck('path')->toArray();

            if (!in_array($currentUrl, $loggedUrls) && !$user) {
                app('tracker')->boot();
            }
        }

        return $next($request);
    }
}
