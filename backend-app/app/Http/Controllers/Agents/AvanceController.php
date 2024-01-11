<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvanceController extends Controller
{
    // ###################################################################  
    public function indexAvance(Request $request)
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($request->input('avancement')) {
            $agents = $this->getAgentsAvance();
        }
        if ($request->input('avance6mois')) {
            $agents = $this->avanceSixMois();
        }
        if ($request->input('avanceTard')) {
            $agents = $this->avanceTard();
        }
        
        $agentFiltre =  $agents->map(function ($agent) {
            $grades_duree = $agent->grades->grade_duree_requise;
            $dernier_avance = Carbon::parse($agent->avance_date);
            $prochaine_avance = $dernier_avance->copy()->addYears($grades_duree);

            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "dernier_avance" => $dernier_avance->toDateString(),
                "prochaine_avance" => $prochaine_avance->toDateString(),
                "ministere" => $agent->uadms == null ? '' :  $agent->uadms->uadm_libelle,
                "section" => $agent->section->soa_libelle,
                "grades_duree" => $grades_duree,
                // "uadm"=> $agent->uadms->uadm_libelle,
            ];
        })->values();

        return response()->json([
            "user" => $user_role,
            "DataAgents" => $agentFiltre,
            "message" => 'Tout les donnees sont recuperer',
            "code" => 200
        ]);
    }
    // ###################################################################  
    //Tout les agents recuperer
    public function getAgentsAvance()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)->get();
        }
        if ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get();
        }
    }

    // ###################################################################  
    //Tout les agents avancer dans 6 mois recuperer
    public function avanceSixMois()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) {

                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                });
        }
        if ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) {

                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                });
        }
    }

    // ###################################################################  

    public function avanceTard()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');

           return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->lt(Carbon::now());
                });
        }
        if ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->lt(Carbon::now());
                });
        }
    
    }

    // ###################################################################  
    public function avanceDeuxDate(Request $request)
    {
        $user = Auth::user();
        $user_role = $user->role;

        $datedebut = $request->input('datedebut');
        $datefin = $request->input('datefin');

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            $agents = Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent)  use ($datedebut, $datefin) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->isBetween(Carbon::parse($datedebut), Carbon::parse($datefin));
                });
        }
        if ($user_role == 'ADMIN') {
            $agents = Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent)  use ($datedebut, $datefin) {

                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->isBetween(Carbon::parse($datedebut), Carbon::parse($datefin));
                });
        }
        $agentFiltre =  $agents->map(function ($agent) {
            $grades_duree = $agent->grades->grade_duree_requise;
            $dernier_avance = Carbon::parse($agent->avance_date);
            $prochaine_avance = $dernier_avance->copy()->addYears($grades_duree);

            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "dernier_avance" => $dernier_avance->toDateString(),
                "prochaine_avance" => $prochaine_avance->toDateString(),
                "ministere" => $agent->uadms == null ? '' :  $agent->uadms->uadm_libelle,
                "section" => $agent->section->soa_libelle,
                "grades_duree" => $grades_duree,
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
