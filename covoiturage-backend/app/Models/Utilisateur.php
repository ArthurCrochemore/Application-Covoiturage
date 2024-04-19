<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
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
        return $this->hasMany(Message::class, 'id_utilisateur');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'id_utilisateur');
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class, 'id_utilisateur');
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'id_utilisateur');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_utilisateur');
    }


    public function alertes()
    {
        return $this->hasMany(Alerte::class, 'id_utilisateur');
    }


    public function voisinage()
    {
        return $this->hasMany(Voisinage::class, 'id_utilisateur');
    }
}
