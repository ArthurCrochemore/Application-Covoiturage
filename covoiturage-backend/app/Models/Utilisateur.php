<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Utilisateur extends Model implements AuthenticatableContract
{

    use Authenticatable;

    use HasFactory;

    protected $table = 'utilisateur';
    protected $primaryKey = 'id_utilisateur';
    public $timestamps = false;
    protected $fillable =
        [
        'nid',
        'nom',
        'prenom',
        'unite',
        'numeroposte',
        'adressepostale',
        'tel',
        'mail',
        'coordonnees',
        'mdp'
    ];
    protected $hidden = [
        'mdp',
    ];


    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'Id_Utilisateur');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'Id_Utilisateur_1');
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class, 'Id_Utilisateur');
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'Id_Utilisateur');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'Id_Utilisateur');
    }


    public function alertes()
    {
        return $this->hasMany(Alerte::class, 'Id_Utilisateur');
    }


    public function voisinage()
    {
        return $this->hasMany(Voisinage::class, 'Id_Utilisateur');
    }
}
