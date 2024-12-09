<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class SaveFormData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post')) {
            Session::put('form_data', array_merge(Session::get('form_data', []), $request->except('_token')));
        }

        // Restore form data on GET requests
        if ($request->isMethod('get')) {
            $request->merge(Session::get('form_data', []));
        }


        return $next($request);
    }
}
