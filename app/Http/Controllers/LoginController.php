<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Web\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->intended(route('user.private'));
        }
        // $request->only - вытащить из запроса только те поля, которые мы передадим в качестве параметров
        $formFields = $request->only(['email', 'password']);
        if (Auth::attempt($formFields)) {
            return redirect()->intended(route('user.private'));
        }
        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
}
