<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'Reservation';

    protected $primaryKey = 'Id_Reservation';

    public $timestamps = false;

    protected $fillable = [
        'DateReservation',
        'Statut',
        'Id_Utilisateur',
        'Id_Trajet',
        'Id_Adresse',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'Id_Trajet');
    }
    public function adresse()
    {
        return $this->belongsTo(Trajet::class, 'Id_Adresse');
    }
}
