<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_agent_matricule',
        'agent_matricule',
        'nom',
        'prenom',
        'date_naissance',
        'cin',
        'sexe',
        'status',
        'code_corps',
        'code_grade',
        'code_hee',
        'code_section',
        'code_fiv',
        'code_sanction',
        'code_uadm',
        'debut_contrat',
        'avance_date',
        'code_ministere',
    ];
    protected $table = 'agents';

    // Relation avec les modèles
    //CORPS
    public function corps()
    {
        return $this->belongsTo(Corps::class, 'code_corps', 'corps_code');
    }
    //GRADE
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'code_grade', 'grade_code');
    }
    //HEE
    public function hee()
    {
        return $this->belongsTo(HEE::class, 'code_hee', 'hee_code');
    }
    //SECTION
    public function section()
    {
        return $this->belongsTo(Section::class, 'code_section', 'section_code');
    }
    //FIV
    public function fiv()
    {
        return $this->belongsTo(Districte::class, 'code_fiv', 'districte_code');
    }
     //UADM
     public function uadms()
     {
         return $this->belongsTo(Uadm::class, 'code_uadm', 'uadm_code');
     }

    //SANCTION
    public function sanction()
    {
        return $this->belongsTo(Sanction::class, 'code_sanction', 'sanction_code');
    }
    //MINISTER
    public function ministere()
    {
        return $this->belongsTo(Ministere::class, 'code_ministere', 'ministere_code');
    }
}
