<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vosinage extends Model
{
    protected $table = 'voisinage';

    protected $primaryKey = 'Id_Voisinage';


    public $timestamps = false;


    protected $fillable = [
        'Id_Utilisateur',
        'Id_Utilisateur1',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }


    public function voisin()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur1');
    }
}
