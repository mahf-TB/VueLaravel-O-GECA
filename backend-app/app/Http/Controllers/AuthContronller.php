<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthContronller extends Controller
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

    public function getAllUser()
    {
        $user = User::all();
        if(!$user){
            return response()->json([
                'messageError' => 'Aucun donnees recuperer',
            ], 401);
        }
        return response()->json([
            'dataUser' => $user,
            'message' => 'les donnees sont recupeerer',
            'code' => 200
        ]);
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:25',
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
        ], 201);
    }
    public function deleteUser($id){
        $user =User::find($id);
        if($user->delete()){
            return response()->json([
                'message'=>'Suppresion user success',
                'status'=>200
            ]);
        }
    }
    public function findUpdateUser($id){
        $user =User::find($id);
        if($user->delete()){
            return response()->json([
                'message'=>'successeful...',
                'user'=>$user,
                'status'=>200
            ]);
        }
    }
    
   
}
