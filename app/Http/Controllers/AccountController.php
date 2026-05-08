<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $dataUser = Auth::user();
        return view('account.edit', compact('dataUser'));
    }

    public function update(Request $request)
    {
        $dataUser = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $dataUser->id,
            'name_kanji' => 'nullable|string|max:255',
            'name_kana'  => 'nullable|string|max:255|regex:/^[ァ-ヶー]+$/u',
        ]);

        $dataUser->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'name_kanji' => $request->name_kanji,
            'name_kana'  => $request->name_kana,
        ]);

        return redirect()->route('mypage.index');
    }
}
