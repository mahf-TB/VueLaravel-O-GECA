<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
{
    public function indexContrat(Request $request)
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($request->input('contractuel')) {
            $agents = $this->getAgentsContrat();
        }
        if ($request->input('contrat6mois')) {
            $agents = $this->contratSixmois();
        }
        if ($request->input('contratTard')) {
            $agents = $this->contratTard();
        }

        $agentFiltre =  $agents->map(function ($agent) {
            $debut_contrat = Carbon::parse($agent->debut_contrat);
            $fin_contrat = $debut_contrat->copy()->addYear(2);
            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "debut_contrat" => $debut_contrat->toDateString(),
                "fin_contrat" => $fin_contrat->toDateString(),
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
    // ###################################################################  
    public function getAgentsContrat()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->whereIn('code_uadm', $user_uadm)
                ->get();
        } elseif ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')->get();
        }
    }

    // ###################################################################  
    public function contratSixmois()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                });
        }
        if ($user_role == 'ADMIN') {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->get()
                ->filter(function ($agent) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                });
        }
    }

    // ###################################################################  
    public function contratTard()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {

            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->lt(Carbon::now());
                });
        } elseif ($user_role == 'ADMIN') {

           return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->get()
                ->filter(function ($agent) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->lt(Carbon::now());
                });
        }

    }

    // ###################################################################  
    public function contratDeuxDate(Request $request)
    {
        $user = Auth::user();
        $user_role = $user->role;

        $datedebut = $request->input('datedebut');
        $datefin = $request->input('datefin');

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            $agents = Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) use ($datedebut, $datefin) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->isBetween(Carbon::parse($datedebut), Carbon::parse($datefin));
                });
        } elseif ($user_role == 'ADMIN') {
            $agents = Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->get()
                ->filter(function ($agent) use ($datedebut, $datefin) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->isBetween(Carbon::parse($datedebut), Carbon::parse($datefin));
                });
        }



        $agentFiltre =  $agents->map(function ($agent) {
            $debut_contrat = Carbon::parse($agent->debut_contrat);
            $fin_contrat = $debut_contrat->copy()->addYear(2);
            return [
                "id" => $agent->id,
                "agent_matricule" => $agent->agent_matricule,
                "noms" => $agent->nom . ' ' . $agent->prenom,
                "status" => $agent->status,
                "corps" => $agent->code_corps,
                "grade" => $agent->code_grade,
                "debut_contrat" => $debut_contrat->toDateString(),
                "fin_contrat" => $fin_contrat->toDateString(),
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
