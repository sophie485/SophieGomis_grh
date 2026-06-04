<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;
use App\Models\HistoriquePoste;

class Employe extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'poste',
        'departement_id',
        'date_embauche',
        'salaire',
        'photo',
        'documents',
        'solde_conges'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function historiquePostes()
    {
        return $this->hasMany(HistoriquePoste::class);
    }
    public function conges()
{
    return $this->hasMany(Conge::class);
}
}