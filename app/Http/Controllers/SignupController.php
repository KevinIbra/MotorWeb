<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function create()
    {
        return view("auth.signup");
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Simpan user ke database
        try {
            $userId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan data ke session
            Session::put('user_id', $userId);
            Session::put('user_name', $request->name);
            Session::put('user_email', $request->email);

            return redirect('/')->with('success', 'Pendaftaran berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
