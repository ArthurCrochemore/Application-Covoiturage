<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $table = 'trajet'; // Nom de la table dans la base de données

    protected $primaryKey = 'Id_Trajet'; // Clé primaire de la table

    public $timestamps = false;

    protected $fillable = [
        'PointDepart',
        'PointArrive',
        'DateDepart',
        'NbrePlaces',
        'QteBagages',
        'Desciption',
        'TrajetRegulier',
        'Statut',
        'Id_Utilisateur',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'Id_Trajet');
    }

    public function alertes()
    {
        return $this->hasMany(Alerte::class, 'Id_Trajet');
    }
}
