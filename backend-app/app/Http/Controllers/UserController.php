<?php

namespace App\Http\Controllers;

use App\Models\Uadm;
use App\Models\User;
use App\Models\user_uadm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAllUser()
    {
        $user = User::where('role', 'RH')->get();
        if (!$user) {
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
    // user delete
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return response()->json([
                'message' => 'Suppresion user success',
                'status' => 200
            ]);
        }
    }

    public function findUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'message' => 'successeful...',
                'user' => $user,
                'status' => 200
            ]);
        } 
    }

    public function updateUser($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $request->validate([
            'matricule' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'role' => 'required|string',
        ]);

        if ($user) {
            return response()->json([
                'message' => 'successeful...',
                'user' => $user,
                'status' => 200
            ]);
        }
    }

    public function getUadm()
    {
        $uadm = Uadm::all();
        return response()->json([
            "dataSection" => $uadm,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
    
    public function addUserUadm($id, Request $request)
    {
        $uadms = $request->input('SecArray');
        foreach ($uadms as $uadm) {
            $value = user_uadm::create([
                "user_id" => $id,
                "code_uadm" => $uadm,
            ]);
        }
        return  response()->json([
            'message' => 'UADM inseret avec success',
            'uadm' => $value,
            'status' => 201
        ]);
    }
}
