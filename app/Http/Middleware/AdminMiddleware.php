<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
      if(Auth::check())
      {   if(Auth::user()->admin == 'si')
          {
            return $next($request);
          }
          else{
return $next($request);
          }
      }
      return $next($request);
    }
}
