<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habiter extends Model
{
    use HasFactory;
    protected $table = 'Habiter';

    protected $primaryKey = '';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['Id_Utilisateur', 'Id_Adresse'];

    public function utilisateur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }

    public function adresse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Adresse::class, 'Id_Adresse');
    }

}
