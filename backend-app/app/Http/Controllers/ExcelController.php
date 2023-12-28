<?php

namespace App\Http\Controllers;

use App\Imports\AgentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //
    public function importExcel(Request $request){
        $request->validate([
            'file_agents' => 'required|mimes:xlsx,xls',
        ]);
        $file = $request->file('file_agents');
        try {
            Excel::import(new AgentsImport, $file);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'importation du fichier Excel.',
                'error' => $e->getMessage(),
                'status' => 500,
            ]);
        }
        
        return  response()->json([
            'message' => 'success',
            'status'=> 201
        ]);
    }
}
