<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $table = 'Trajet';

    protected $primaryKey = 'Id_Trajet';

    public $timestamps = false;

    protected $fillable = [
        'Date_Depart',
        'Heure_Depart',
        'Qte_Bagages',
        'Description',
        'Trajet_Regulier',
        'Statut',
        'Id_Conducteur',
        'Id_Domicile',
        'Id_Base',
        'Nbre_Places',
        'Domicile_Base',
        'Id_Jours',
        'Id_Conducteur'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Conducteur');
    }
    public function domicile()
    {
        return $this->belongsTo(Adresse::class, 'Id_Adresse');
    }
    public function base()
    {
        return $this->belongsTo(Adresse::class, 'Id_Adresse');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'Id_Trajet');
    }

    public function alertes()
    {
        return $this->hasMany(Alerte::class, 'Id_Trajet');
    }

    public function jours()
    {
        return $this->belongsTo(Jours::class, 'Id_Jours');
    }

}
