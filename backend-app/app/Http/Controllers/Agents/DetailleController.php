<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailleController extends Controller
{
    //
    // ###################################################################  
    public function AgentDetailler($id)
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms', 'fiv', 'sanction'])->where('id', $id)
                ->whereIn('code_uadm', $user_uadm)->get();
        }
        if ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms', 'fiv', 'sanction'])->where('id', $id)
                ->get();
        }
    }

    public function indexDetaille($id)
    {
        $agent = $this->AgentDetailler($id);

        $agentFiltre =  $agent->map(function ($agent) {
            $grades_duree = $agent->grades->grade_duree_requise;
            $dernier_avance = Carbon::parse($agent->avance_date);
            $prochaine_avance = $dernier_avance->copy()->addYears($grades_duree);

            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "CIN" => $agent->cin,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "dernier_avance" => $dernier_avance->toDateString(),
                "prochaine_avance" => $prochaine_avance->toDateString(),
                "uadm" => $agent->uadms == null ? '' :  $agent->uadms->uadm_libelle,
                "section" => $agent->section->soa_libelle,
                "ministere" => $agent->ministere->ministere_libelle,
                "district" => $agent->fiv->districte_code.' '.$agent->fiv->districte_libelle,
                "sanction" => $agent->sanction->sanction_libelle,
              
            ];
        });

        return response()->json([
            "DataAgents" => $agentFiltre,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
}
