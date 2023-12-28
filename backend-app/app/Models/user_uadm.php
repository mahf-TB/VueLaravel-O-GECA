<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_uadm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code_uadm',
    ];

    protected $table = 'user_uadms';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function uadms()
    {
        return $this->belongsTo(Uadm::class, 'code_uadm');
    }
}
