<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }
    public function registre(){
        return view('auth.registre');
    }
    public function inscription(RegistreRequest $request){
        $data = array(
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' =>$request->password,
            'profil' => 2
        );
        User::insert($data);
        return redirect()->route('login');
    }
    public function home(){
        return view('base');
    }
    public function se_login(LoginRequest $request){
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Session::put('user_id', $user->id);
            Session::put('profil_id', $user->profil->id);
            return redirect()->intended('parkings');
        }
        // L'authentification a échoué, redirection avec les erreurs de validation
        return back()->withErrors([
            'password' => 'Identifiant Invalid',
        ])->withInput();
    }
    public function deconnexion(){
        Auth::logout();
        Session::forget('user_id');
        Session::forget('profil_id');
        return redirect()->route('login');
    }
}
