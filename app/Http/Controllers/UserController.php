<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email', 'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return Response()->json(['message' => 'ورود موفقیت امیز بود.']);
        }

        return back()->withErrors(['email' => 'اطلاعات ورودی اشتباه است.',
            ]);
    }
}

