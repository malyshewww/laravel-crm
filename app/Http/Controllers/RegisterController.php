<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Web\Controllers\Controller;

class RegisterController extends Controller
{
    public function save(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('claim.index');
        }
        $validateFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (User::where('email', $validateFields['email'])->exists()) {
            return redirect()->route('registration')->withErrors([
                'email' =>  'Такой пользователь уже зарегистрирован'
            ]);
        }
        $user = User::create($validateFields);
        if ($user) {
            Auth::login($user);
            return redirect()->route('claim.index');
        }
        return redirect(route('login'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
}
