<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function section(){
        $section = Section::all();
        return response()->json([
            "dataSection"=> $section,
            "message"=> 'Tout les donnees sont recuperer',
            "code"=>200
        ]);
    }
}
