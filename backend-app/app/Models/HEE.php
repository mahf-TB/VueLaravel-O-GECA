<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HEE extends Model
{
    use HasFactory;
    protected $fillable = [
        'hee_code' ,
        'hee_libelle',
        'categorie',
        'indice',
    ];

    protected $table = 'hees';
    public $timestamps = false;
}
