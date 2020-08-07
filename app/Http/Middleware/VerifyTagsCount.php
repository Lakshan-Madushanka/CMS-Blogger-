<?php

namespace App\Http\Middleware;

use App\Category;
use App\Tag;
use Closure;

class VerifyTagsCount
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
        if(Tag::all()->count() === 0) {

            session()->flash('error', "You nee to add one or more tags first");

            return redirect(route('tags.create'));
        }

        return $next($request);
    }
}
