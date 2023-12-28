<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'addUser',]]);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'matricule-mail' => 'required',
            'password' => 'required',
        ]);
        
        $loginId = $request->input('matricule-mail');
        $isEmail = filter_var($loginId, FILTER_VALIDATE_EMAIL) !== false;
        
        $credentials = [
            $isEmail ? 'email' : 'matricule' => $loginId,
            'password' => $request->input('password'),
        ];

        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
                'success'=>401
            ]);
        }
        return $this->createToken($token);
    }

    public function createToken($token)
    {
        return response()->json([
                'token' => $token,
                'success'=>200,
                'message' => 'Vous etes connecter...',
                'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }

    public function getUser()
    {
        return response()->json(auth()->user());
    }


    public function addUser(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);
        $user = User::create([
            "matricule" => $request->matricule,
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => $request->role,
        ]);

        return  response()->json([
            'message' => 'Utilisateur creer avec success',
            'user' => $user,
            'status'=> 201
        ]);
    }
   

   
}
