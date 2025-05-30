<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion
     */
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirection vers la page suivis après connexion
            return redirect()->route('suivis.index');
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ])->onlyInput('email');
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription
     */
    public function registerPost(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Redirection vers la page suivis après inscription
        return redirect()->route('suivis.index');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
