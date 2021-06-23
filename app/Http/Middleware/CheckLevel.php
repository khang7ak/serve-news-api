<?php

namespace App\Http\Middleware;

use Closure;
use Auth;   
use User;

class CheckLevel
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
        $user = Auth::user();
        // dd($user);
        if($user == null){
            return redirect()->route('login');
        }
        else if($user->level == 1)
        {
            // dd($user);
            return redirect()->route('post.index');
        }
        else if($user->level == 2)
        {
            return redirect()->route('home');
        }
        // else if($user->level == null)
        // {
        //     return redirect()->route('home');
        // }
        
        else{
            return $next($request);
        }
        
    }
}
