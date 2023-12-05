<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    public function handle($request, Closure $next)
    {
        $age = $request->route('age');
        if (!is_numeric($age) || $age < 18) {
            return redirect('/result')->with('error', 'You should be at lease 18!');
        }

        return $next($request);
    }
}
