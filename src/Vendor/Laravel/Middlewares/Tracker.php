<?php

namespace PragmaRX\Tracker\Vendor\Laravel\Middlewares;

use Closure;
use Illuminate\Support\Facades\Config;
use PragmaRX\Tracker\Vendor\Laravel\Models\Log;

class Tracker
{
    public function handle($request, Closure $next)
    {
        if (Config::get('tracker.enabled')) {
            $user = auth()->user();
            $currentUrl = $request->path();
            $currentSession = session()->get(Config::get('tracker.tracker_session_name'));

            if (!$currentSession || empty($currentSession['id'])) {
                $urlExists = false;
            } else {
                $urlExists = Log::query()
                    ->where('session_id', $currentSession['id'])
                    ->join('tracker_paths', 'tracker_log.path_id', '=', 'tracker_paths.id')
                    ->where('tracker_paths.path', $currentUrl)
                    ->exists();
            }

            // Nếu không phải là admin hoặc là current session này chưa xem page này thì boot Tracker
            if (!$user && !$urlExists) {
                app('tracker')->boot();
            }
        }

        return $next($request);
    }
}
