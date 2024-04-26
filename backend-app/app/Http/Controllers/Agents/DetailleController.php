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
    public function indexDetailleContrat($id)
    {
        $agent = $this->AgentDetailler($id);

        $agentFiltre =  $agent->map(function ($agent) {
            $debut_contrat = Carbon::parse($agent->debut_contrat);
            $fin_contrat = $debut_contrat->copy()->addYear(2);
            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "CIN" => $agent->cin,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "debut_contrat" => $debut_contrat->toDateString(),
                "fin_contrat" => $fin_contrat->toDateString(),
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
    public function indexDetailleRetraite($id)
    {
        $agent = $this->AgentDetailler($id);

        $agentFiltre =  $agent->map(function ($agent) {
            $date_naissance = Carbon::parse($agent->date_naissance);
            $date_retrait = $date_naissance->copy()->addYear(60);
            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "CIN" => $agent->cin,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "date_naissance" => $date_naissance->toDateString(),
                "date_retrait" => $date_retrait->toDateString(),
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
