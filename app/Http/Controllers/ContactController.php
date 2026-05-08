<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw(
            "名前: {$request->name}\nメール: {$request->email}\n\n{$request->message}",
            function ($mail) use ($request) {
                $mail->to(config('mail.from.address'))
                     ->subject('お問い合わせ: ' . $request->name)
                     ->replyTo($request->email, $request->name);
            }
        );

        return redirect()->route('products.index');
    }
}
