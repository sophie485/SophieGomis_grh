<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriquePoste extends Model
{
    protected $fillable = [
        'employe_id',
        'poste',
        'date_debut',
        'date_fin',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
