<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uadm extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasMany(user_uadm::class, 'code_uadm');
    }

}
