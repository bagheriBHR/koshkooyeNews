<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;

class IsActive
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
        $setting = Setting::where('is_active',1)->get();
        if(count($setting)){
            return $next($request);
        }else{
            return response()->view('errors.down');
        }

    }

}
