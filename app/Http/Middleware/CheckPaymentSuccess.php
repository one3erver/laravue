<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentSuccess
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('payment_successful')) {
            return $next($request);
        }
        else {
            return redirect('/')->with('error', 'Access denied');
        }
    }
}
