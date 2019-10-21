<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class Admin
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
        //check if the user is logged in
        if(Auth::check()){
            
            //check if the logged in user is an sdmin
            if(Auth::user()->isAdmin()){
                
               return $next($request);
                
            } 
            
        } 
        
        return redirect('home');
        //return 'Sorry not authorized';
    }
    
}
