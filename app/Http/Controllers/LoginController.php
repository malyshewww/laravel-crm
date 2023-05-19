<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Web\Controllers\Controller;

class LoginController extends Controller
{
    protected $maxAttempts = 3; // default is 5
    protected $decayMinutes = 2; // default is 1
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->intended(route('claim.index'));
        }
        // $request->only - вытащить из запроса только те поля, которые мы передадим в качестве параметров
        $formFields = $request->only(['email', 'password']);
        if (Auth::attempt($formFields)) {
            // $request->session()->regenerate();
            return redirect()->intended(route('claim.index'));
        }
        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('user.login'));
    }
}
