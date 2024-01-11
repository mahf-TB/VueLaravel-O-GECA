<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetraiteController extends Controller
{

    public function indexRetraite(Request $request)
    {

        $user = Auth::user();
        $user_role = $user->role;

        if ($request->input('retraite')) {
            $agents = $this->getAgentsRetraite();
        }
        if ($request->input('retraite1ans')) {
            $agents = $this->getAgentsRetraite1ans();
        }
        if ($request->input('retraiteTard')) {
            $agents = $this->getAgentsRetraiteTard();
        }

        $agentFiltre =  $agents->map(function ($agent) {
            $date_naissance = Carbon::parse($agent->date_naissance);
            $date_retrait = $date_naissance->copy()->addYear(60);
            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "date_naissance" => $date_naissance->toDateString(),
                "date_retrait" => $date_retrait->toDateString(),
                "ministere" => $agent->uadms == null ? '' :  $agent->uadms->uadm_libelle,
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
    //  ###################################################################  
    public function getAgentsRetraite()
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


    //  ###################################################################  
    public function getAgentsRetraite1ans()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)->get()
                ->filter(function ($agent) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->isBetween(Carbon::now(), Carbon::now()->addMonths(12));
                });
        }
        if ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->isBetween(Carbon::now(), Carbon::now()->addMonths(12));
                });
        }
    }

    //  ###################################################################   
    public function getAgentsRetraiteTard()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');

            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)->get()
                ->filter(function ($agent) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->lt(Carbon::now());
                });
        }
        if ($user_role == 'ADMIN') {

            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->lt(Carbon::now());
                });
        }
    }


    //  ###################################################################  
    public function getRetraiteDeuxDate(Request $request)
    {
        $user = Auth::user();
        $user_role = $user->role;


        $datedebut = $request->input('datedebut');
        $datefin = $request->input('datefin');

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            $agents = Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->whereIn('code_uadm', $user_uadm)->get()
                ->filter(function ($agent)  use ($datedebut, $datefin) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->isBetween(Carbon::parse($datedebut), Carbon::parse($datefin));
                });
        }
        if ($user_role == 'ADMIN') {
            $agents = Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) use ($datedebut, $datefin) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->isBetween(Carbon::parse($datedebut), Carbon::parse($datefin));
                });
        }

        $agentFiltre =  $agents->map(function ($agent) {
            $date_naissance = Carbon::parse($agent->date_naissance);
            $date_retrait = $date_naissance->copy()->addYear(60);
            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "date_naissance" => $date_naissance->toDateString(),
                "date_retrait" => $date_retrait->toDateString(),
                "ministere" => $agent->uadms == null ? '' :  $agent->uadms->uadm_libelle,
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
