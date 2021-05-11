<?php

namespace App\Http\Middleware;
use App\Models\category;
use Closure;
use Illuminate\Http\Request;

class check_category
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
        $count=category::all()->count();
        if($count==0)
        {
            session()->flash('error_category', 'u have to add category first');
            return redirect(route('categories.create'));

        }
        return $next($request);
    }
}
