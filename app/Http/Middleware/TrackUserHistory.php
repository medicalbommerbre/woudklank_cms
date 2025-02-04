<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TrackUserHistory
{
    public function handle($request, Closure $next)
    {
        $previousUrl = url()->previous();
        $history = Session::get('history', []);

        array_unshift($history, $previousUrl);
        $history = array_slice($history, 0, 3);

        Session::put('history', $history);

        return $next($request);
    }
}

