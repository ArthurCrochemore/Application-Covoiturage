<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;
    protected $table = 'Rapport';

    protected $primaryKey = 'Id_Rapport';

    public $timestamps = false;

    protected $fillable = [
        'Description',
        'Date_Rapport',
        'Statut',
        'Id_Utilisateur',
    ];

    public function utilisateur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }
}
