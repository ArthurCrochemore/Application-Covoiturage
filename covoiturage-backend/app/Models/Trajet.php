<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static create(array $validatedData)
 * @method static find($id)
 */
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

    public function utilisateur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Conducteur');
    }
    public function domicile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Adresse::class, 'Id_Domicile');
    }
    
    public function base()
    {
        return $this->belongsTo(Adresse::class, 'Id_Base');
    }
    

    public function jours(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Jours::class, 'Id_Jours');
    }

    public function reservations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reservation::class, 'Id_Trajet');
    }

    public function alertes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Alerte::class, 'Id_Trajet');
    }

    public function jours()
    {
        return $this->belongsTo(Jours::class, 'Id_Jours');
    }

}
