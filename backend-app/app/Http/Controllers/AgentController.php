<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    //

    public function getAgentsAvance()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return response()->json([
                "user" => $user_role,
                "user_uadms" => $user_uadm,
                "message" => 'Tout les donnees sont recuperer',
                "code" => 200
            ]);
        }

        $agents = Agent::with(['ministere', 'section', 'grades'])->get();
        $agentFiltre =  $agents->map(function ($agent) {
            $grades_duree = $agent->grades->grade_duree_requise;
            $dernier_avance = Carbon::parse($agent->avance_date);
            $prochaine_avance = $dernier_avance->copy()->addYears($grades_duree);

            return [
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom.' '.$agent->prenom,
                "status"=>$agent->status,
                "corps"=>$agent->code_corps,
                "grade"=>$agent->code_grade,
                "dernier_avance"=>$dernier_avance->toDateString(),
                "prochaine_avance"=>$prochaine_avance->toDateString(),
                "ministere" => $agent->ministere->ministere_libelle,
                "section" => $agent->section->soa_libelle,
                "grades_duree" => $grades_duree,
            ];
        });
        return response()->json([
            "user" => $user_role,
            "DataAgents" => $agentFiltre,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
    public function getAgentsContrat()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return response()->json([
                "user" => $user_role,
                "user_uadms" => $user_uadm,
                "message" => 'Tout les donnees sont recuperer',
                "code" => 200
            ]);
        }

        $agents = Agent::with(['ministere', 'section', 'grades'])->where('status', 'CONTRACTUEL')->get();
        $agentFiltre =  $agents->map(function ($agent) {
            $debut_contrat = Carbon::parse($agent->debut_contrat);
            $fin_contrat = $debut_contrat->copy()->addYear(2);
            return [
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom.' '.$agent->prenom,
                "status"=>$agent->status,
                "corps"=>$agent->code_corps,
                "grade"=>$agent->code_grade,
                "debut_contrat"=>$debut_contrat->toDateString(),
                "fin_contrat"=>$fin_contrat->toDateString(),
                "ministere" => $agent->ministere->ministere_libelle,
                "section" => $agent->section->soa_libelle,
            ];
        });
        return response()->json([
            "user" => $user_role,
            "DataAgents" => $agentFiltre,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
    public function getAgentsRetraite()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return response()->json([
                "user" => $user_role,
                "user_uadms" => $user_uadm,
                "message" => 'Tout les donnees sont recuperer',
                "code" => 200
            ]);
        }elseif($user_role == 'ADMIN'){
            $agents = Agent::with(['ministere', 'section', 'grades'])
            ->get()
            ->filter(function ($agent) {
                $date_naissance = Carbon::parse($agent->date_naissance);
                $date_retrait = $date_naissance->copy()->addYear(60);
                // Filtrer les agents dont la date de retrait est dans la plage d'aujourd'hui jusqu'à 12 mois plus tard
                return $date_retrait->isBetween(Carbon::now(), Carbon::now()->addMonths(12));
            });
        }
    
        $agentFiltre =  $agents->map(function ($agent) {
            $date_naissance = Carbon::parse($agent->date_naissance);
            $date_retrait = $date_naissance->copy()->addYear(60);
            return [
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom.' '.$agent->prenom,
                "status"=>$agent->status,
                "corps"=>$agent->code_corps,
                "grade"=>$agent->code_grade,
                "date_naissance"=>$date_naissance->toDateString(),
                "date_retrait"=>$date_retrait->toDateString(),
                "ministere" => $agent->ministere->ministere_libelle,
                "section" => $agent->section->soa_libelle,
            ];
        })->values();

        return response()->json([
            "user" => $user_role,
            "DataAgents" => $agentFiltre,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
}
