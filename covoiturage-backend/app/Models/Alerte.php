<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $table = 'alerte';

    protected $primaryKey = 'Id_Alerte';


    public $timestamps = false;


    protected $fillable = [
        'Statut',
        'Id_Trajet',
        'Id_Utilisateur',
    ];

    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'Id_Trajet');
    }


    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }
}
