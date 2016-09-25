<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use App\Helpers\Response as Response;
use App\Helpers\Helper as Helper;

class BeforeMiddleware
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
        return $next($request);
    }
}
