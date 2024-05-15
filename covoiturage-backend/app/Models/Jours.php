<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jours extends Model
{
    use HasFactory;

    protected $table = 'Jours';

    protected $primaryKey = 'Id_Jours';

    protected $fillable = [
        'Lundi',
        'Mardi',
        'Mercredi',
        'Jeudi',
        'Vendredi',
        'Samedi',
        'Dimanche',
    ];
}
