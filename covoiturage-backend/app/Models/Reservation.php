<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $primaryKey = 'Id_Reservation';

    public $timestamps = false;

    protected $fillable = [
        'DateReservation',
        'Statut',
        'Id_Utilisateur',
        'Id_Trajet',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'Id_Trajet');
    }
}
