<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBranch
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('selected_branch')) {
            return redirect()->route('branch.selector')
                ->with('error', 'Please select a branch first!');
        }

        return $next($request);
    }
}
