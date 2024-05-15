<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habiter extends Model
{
    protected $table = 'Habiter';

    protected $primaryKey = '';

    protected $fillable = ['Id_Utilisateur', 'Id_Adresse'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }

    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'Id_Adresse');
    }

}
