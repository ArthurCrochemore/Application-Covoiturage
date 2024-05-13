<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $table = 'trajet'; 

    protected $primaryKey = 'Id_Trajet'; 

    public $timestamps = false;

    protected $fillable = [
        'pointdepart',
        'pointarrive',
        'datedepart',
        'nbreplaces',
        'qtebagages',
        'description',
        'trajetregulier',
        'statut',
        'id_utilisateur',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
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
