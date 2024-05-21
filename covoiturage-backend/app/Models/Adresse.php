<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $table = 'Adresse';

    protected $primaryKey = 'Id_Adresse';
    protected $fillable = ['Intitule', 'Ville', 'Est_Base_Aérienne'];

}
