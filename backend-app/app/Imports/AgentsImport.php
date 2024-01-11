<?php

namespace App\Imports;

use App\Models\Agent;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use function Ramsey\Uuid\v1;

class AgentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        

            return  new Agent([
                'post_agent_matricule' => $row[0],
                'agent_matricule' => $row[1],
                'nom' => $row[2],
                'prenom' => $row[3],
                'date_naissance' => $row[4]==''?null: Carbon::parse($row[4]),
                'cin' => $row[5],
                'sexe' => $row[6],
                'status' => $row[7],
                'code_corps' => $row[8],
                'code_grade' => $row[9],
                'code_hee' => $row[10],
                'code_section' => $row[11],
                'code_fiv' => $row[12],
                'code_sanction' => $row[13],
                'code_uadm' => $row[14],
                'debut_contrat' => $row[15]==''?null: Carbon::parse($row[15]),
                'avance_date' => $row[16] ==''?null: Carbon::parse($row[16]),
                'code_ministere' => $row[17],
            ]);
       
    }
} 
