<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'addUser']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // $loginId = $request->input('username');
        // $isEmail = filter_var($loginId, FILTER_VALIDATE_EMAIL) !== false;

        $credentials = [
             'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
                'success' => 401
            ]);
        }
        return $this->createToken($token);
    }

    public function createToken($token)
    {
        return response()->json([
            'token' => $token,
            'success' => 200,
            'message' => 'Vous etes connecter...',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }

    public function getUser()
    {
        $user = Auth::user();

        // Utilisez l'URL de l'image directement
        if ($user->pdp != null) {
            $user->pdp = 'http://127.0.0.1:8000/storage/'. $user->pdp;
        }else {
            # code...
            $user->pdp = 'http://127.0.0.1:8000/storage/photo/avatar.jpg';
        }

        return response()->json($user);
    }


    public function addUser(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);
        $user = User::create([
            "matricule" => $request->matricule,
            "username" => $request->username,
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => $request->role,
        ]);
        if ($user) {
            return  response()->json([
                'message' => 'Utilisateur create avec success',
                'user' => $user,
                'status' => 201
            ]);
        }
    }


    public function viderTableAgents()
    {
        Agent::truncate();
        return  response()->json([
            'message' => 'Suppression de tout les données sont effectuer...',
            'status' => 201
        ]);
    }
}
