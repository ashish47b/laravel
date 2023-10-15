<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if(!session()->has('userid') && ($request->path() != '/'  && $request->path() != '/User-Register')){
             return redirect('/');
         }
         if(!session()->has('userid') && ($request->path() != '/'  || $request->path() != '/User-Register')){
            return back();
        }
        return $next($request)->header('Cache-Control','no-cache, no-store,max-age=0,must-revalidate')->header('Pragma','no-cache')->header('Expires','Sat 01 Jan 199000:00:00 GMT');
    }
}
