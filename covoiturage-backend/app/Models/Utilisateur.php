<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * @property int $Id_Utilisateur
 * @property string $NID
 * @property string $Nom
 * @property string $Prenom
 * @property string $Unite
 * @property string $Numero_De_Poste
 * @property string $Numero_De_Telephone
 * @property string $Mail
 * @property string $Mot_De_Passe
 * @method static where(string $string, mixed $Mail)
 * @method static create(array $validatedData)
 */


class Utilisateur extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;

    protected $table = 'Utilisateur';
    protected $primaryKey = 'Id_Utilisateur';
    public $timestamps = false;

    protected $fillable = [
        'NID',
        'Nom',
        'Prenom',
        'Unite',
        'Numero_De_Poste',
        'Numero_De_Telephone',
        'Mail',
        'Mot_De_Passe'
    ];

    protected $hidden = [
        'Mot_De_Passe',
    ];

    public function messagesEnvoyes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'Id_Utilisateur');
    }

    public function messagesRecus(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'Id_Utilisateur');
    }

    public function trajets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trajet::class, 'Id_Conducteur');
    }

    public function rapports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rapport::class, 'Id_Utilisateur');
    }

    public function reservations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reservation::class, 'Id_Utilisateur');
    }

    public function alertes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Alerte::class, 'Id_Utilisateur');
    }

    public function habiter(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Habiter::class, 'Id_Utilisateur');
    }
}
