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
        try {
            $user = User::find($id);
            $users = $user->update([
                "matricule" => $request->matricule,
                "username" => $request->username,
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "email" => $request->email,
                "role" => $request->role,
            ]);
            if ($users) {
                // Supprimer les relations user_uadm existantesjson_encode($uadms)
                user_uadm::where('user_id', $id)->delete();
                $uadms =$request->uadmArray;
                foreach ($uadms as $uadm) {
                    user_uadm::create([
                        "user_id" => $id,
                        "code_uadm" => $uadm,
                    ]);
                }
            }

            return response()->json([
                'message' => 'successeful...',
                'user' => $uadms,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour',
                'error' => $e->getMessage(),
                'status' => 500
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

    public function getUadmUser($id)
    {
        $uadm = user_uadm::where('user_id', $id)->get();
        $tabuadm = $uadm->pluck('code_uadm')->toArray();
        $uadms = Uadm::whereIn('uadm_code', $tabuadm)->get();
        return response()->json([
            "user_id" => $id,
            "UadmDeUser" => $uadms,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
}
