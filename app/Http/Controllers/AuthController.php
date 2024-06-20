<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function show()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $infoLogin = $request->validate([
            'email' => 'required',
            'password' => 'required', 
        ]);

        try {
            if (Auth::guard('pegawai')->attempt($infoLogin)) {
                $request->session()->regenerate();
                return to_route('dashboard');
            } elseif ((Auth::guard('web')->attempt($infoLogin))) {
                $request->session()->regenerate();
                return to_route('dashboard');
            } else{
                return redirect('/')->with('error', 'Password atau Email anda salah. Silahkan coba lagi');
            }
            
        } catch (\Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        }

        if(Auth::guard('pegawai')->check()){
            Auth::guard('pegawai')->logout();
        }

        return redirect('/');
    }
}
