<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;
    protected $table = 'Alerte';

    protected $primaryKey = 'Id_Alerte';


    public $timestamps = false;


    protected $fillable = [
        'Statut',
        'Trajet_Regulier',
        'Domicile_Base',
        'Date_Alerte_Trajet',
        'Id_Trajet',
        'Id_Utilisateur',
        'Id_Jours',
        'Id_Domicile',
        'id_Base' // TODO : rename
    ];

    public function trajet(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trajet::class, 'Id_Trajet');
    }


    public function utilisateur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }
    public function jours(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Jours::class, 'Id_Jours');
    }

    public function domicile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Adresse::class, 'Id_Domicile');
    }

    public function base(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Adresse::class, 'Id_Base');
    }



}
