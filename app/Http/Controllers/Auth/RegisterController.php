<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'name_kanji' => 'nullable|string|max:255',
            'name_kana'  => 'nullable|string|max:255|regex:/^[ァ-ヶー]+$/u',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        $dataUser = User::create([
            'name'       => $request->name,
            'name_kanji' => $request->name_kanji,
            'name_kana'  => $request->name_kana,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        Auth::login($dataUser);

        return redirect()->route('products.index');
    }
}
