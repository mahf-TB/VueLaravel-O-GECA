<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['updateUserAuth']]);
    }
    //
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            # code...
            $user_img =Auth::user();
            if ($user_img->pdp) {
                Storage::delete($user_img->pdp);
            }
            $link = Storage::put('/photo', $request->file('image'));
            
            $user_img->update([
                "pdp" => $link,
            ]);
            return response()->json([
                'message' => 'upload picture has successeful...',
                'status' => 200
            ]);
        }
    }
    public function updateUserAuth(Request $request)
    {

        $user = Auth::user();
        $users = $user->update([
            "matricule" => $request->matricule,
            "username" => $request->username,
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,

        ]);
        return response()->json([
            'message' => 'successeful...',
            'user' => $users,
            'status' => 200
        ]);
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_pass' => 'required|min:6|max:100',
            'new_pass' => 'required|min:6|max:100',
            'confirm_pass' => 'required|same:new_pass',
        ]);
        $user = Auth::user();
        // $user->password == bcrypt($request->old_pass)
        if (Hash::check($request->old_pass, $user->password)) {
            # code...
            $users = $user->update([
                "password" => bcrypt($request->confirm_pass)
            ]);
            return response()->json([
                'message' => 'successeful...',
                'user' => $users,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'error...',
                'status' => 500
            ]);
        }
    }
}
