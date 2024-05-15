<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $table = 'Rapport';

    protected $primaryKey = 'Id_Rapport';

    public $timestamps = false;

    protected $fillable = [
        'Description',
        'DateRapport',
        'Status',
        'Id_Utilisateur',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }
}
