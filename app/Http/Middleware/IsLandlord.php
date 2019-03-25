<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsLandlord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->landlord()->exists())
            return $next($request);
        else{
            if ($request->expectsJson()) {
                return response()->json(['status' => false , 'error' => 'Landlord permission needed'], 401);
            }

            return redirect('notlandlord');
        };
    }
}
