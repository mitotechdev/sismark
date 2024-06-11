<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    //

    public function login(Request $request)
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
         
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            Auth::logoutOtherDevices($request->password);
            return redirect()->intended('/');
        }
 
        return back()->with(
            'error', 'The provided credentials do not match our records.',
        )->onlyInput('username');
    }
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();


        $request->session()->flush();

        $request->session()->regenerateToken();
    
        return redirect()->route('login');

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
