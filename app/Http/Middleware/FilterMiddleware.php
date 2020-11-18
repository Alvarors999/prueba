<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterMiddleware
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
        // if($request->input('user') !== 'pepe') {
        //     return redirect('https://google.es');
        // }
        $request->original = $request->user;
        $request->user = strtoupper($request->user);
        $request->aplicacion = "MIDDLEWARE";
        $request->request->add(['variable' => 'value']);
        
        return $next($request);
    }
}
