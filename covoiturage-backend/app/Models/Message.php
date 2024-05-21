<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'Message';

    protected $primaryKey = 'Id_Message';


    public $timestamps = false;


    protected $fillable = [
        'Message',
        'Date_Message',
        'Lu',
        'Id_Expediteur',
        'Id_Recepteur',
    ];


    public function expediteur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }


    public function recepteur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur_1');
    }
}
