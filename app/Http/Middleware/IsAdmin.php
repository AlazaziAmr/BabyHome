<?php

namespace App\Http\Middleware;

use App\Helpers\JsonResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  $guard
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) {
            return JsonResponse::errorResponse('Unauthenticated_action');
        }
        // dd($request->user()->tokenCan('admin'));
        // if (!$request->user()->tokenCan('admin')) {
        //     return response()->json([
        //         'message' => "Unauthenticated",
        //     ]);
        // }
        return $next($request);
    }
}
