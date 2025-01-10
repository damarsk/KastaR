<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Showing Login page
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // LOGIN PROCESS
        {  
            // Validasi input  
            $request->validate([  
                'email' => 'required|email',  
                'password' => 'required',  
            ]);  
      
            // Coba login  
            if (Auth::attempt($request->only('email', 'password'))) {  
                // Jika login berhasil, redirect ke halaman dashboard  
                return redirect()->intended('/dashboard');  
            }  
      
            // Jika login gagal, kembali ke halaman login dengan pesan error  
            return back()->withErrors([  
                'email' => 'Email atau password salah.',  
            ]);  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // LOGOUT PROCESS
        {  
            // Logout  
            Auth::logout();  
      
            // Redirect ke halaman login  
            return redirect('/login');  
        }
    }
}
