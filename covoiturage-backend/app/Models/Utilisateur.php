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

    protected $table = 'Utilisateur';
    protected $primaryKey = 'Id_Utilisateur';
    public $timestamps = false;
    protected $fillable =
        [
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


    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'Id_Utilisateur');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'Id_Utilisateur');
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
    public function habiter()
    {
        return $this->hasMany(Habiter::class, 'Id_Utilisateur');
    }
}
