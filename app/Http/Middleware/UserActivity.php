<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Cache;
use Auth;

use App\Models\User;

class UserActivity
{
    
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $auth_id = Auth::id();

            if (!Cache::has('user-active-' . $auth_id)){

                $expiresAt = Carbon::now()->addMinutes(2);
                Cache::put('user-active-' . $auth_id, true, $expiresAt);
            }
        }

        return $next($request);
        
    }
}



