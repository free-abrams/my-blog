<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpToHttpsMiddleware
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
        if ($request->server('REQUEST_SCHEME') === 'http' && $request->method() == 'get') {
            return redirect('https://'.$request->url(), 301);
        }
        return $next($request);
    }
}
