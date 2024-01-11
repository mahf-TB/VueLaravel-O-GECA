<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function countAgents()
    {
        $user = Auth::user();
        $user_role = $user->role;
        $countA1 = $this->avance6mois();
        $countA2 = $this->avancetard();
        $countC1 = $this->contrat6mois();
        $countC2 = $this->contratTard();
        $countR1 = $this->retraite12mois();
        $countR2 = $this->retraitTard();
        return response()->json([
            "user" => $user_role,
            "Avenant6mois" => $countA1,
            "AvenantTard" => $countA2,
            "contrat6mois" => $countC1,
            "contratTard" => $countC2,
            "Retrait1ans" => $countR1,
            "RetraitTard" => $countR2,
            "message" => 'Tout les count donnees sont recuperer',
            "code" => 200
        ]);
    }
    public function avance6mois()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades'])
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                })->count();
        } else {
            return Agent::with(['ministere', 'section', 'grades'])
                ->get()
                ->filter(function ($agent) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                })->count();
        }
    }

    public function avancetard()
    {
        $user = Auth::user();
        $user_role = $user->role;

        if ($user_role == 'RH') {
            $user_uadms = $user->uadms;
            $user_uadm = $user_uadms->pluck('code_uadm');
            return Agent::with(['ministere', 'section', 'grades'])
                ->whereIn('code_uadm', $user_uadm)
                ->get()
                ->filter(function ($agent) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->lt(Carbon::now());
                })->count();
        } else {
            return Agent::with(['ministere', 'section', 'grades'])
                ->get()
                ->filter(function ($agent) {
                    $grades_duree = $agent->grades->grade_duree_requise;
                    $dernier_avance = Carbon::parse($agent->avance_date);
                    $prochaine_avance = $dernier_avance->copy()->addYear($grades_duree);
                    return $prochaine_avance->lt(Carbon::now());
                })->count();
        }
    }

    public function contrat6mois()
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
                })->count();
        } else {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->get()
                ->filter(function ($agent) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->isBetween(Carbon::now(), Carbon::now()->addMonths(6));
                })->count();
        }
    }

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
                })->count();
        } else {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])->where('status', 'CONTRACTUEL')
                ->get()
                ->filter(function ($agent) {
                    $debut_contrat = Carbon::parse($agent->debut_contrat);
                    $fin_contrat = $debut_contrat->copy()->addYear(2);
                    return $fin_contrat->lt(Carbon::now());
                })->count();
        }
    }

    public function retraite12mois()
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
                })->count();
        } else {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->isBetween(Carbon::now(), Carbon::now()->addMonths(12));
                })->count();
        }
    }
    public function retraitTard()
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
                })->count();
        } else {
            return Agent::with(['ministere', 'section', 'grades', 'uadms'])
                ->get()
                ->filter(function ($agent) {
                    $date_naissance = Carbon::parse($agent->date_naissance);
                    $date_retrait = $date_naissance->copy()->addYear(60);
                    return $date_retrait->lt(Carbon::now());
                })->count();
        }
    }
}
