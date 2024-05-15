<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    protected $primaryKey = 'Id_Message';


    public $timestamps = false;


    protected $fillable = [
        'Message',
        'DateMessage',
        'Lu',
        'Id_Expediteur',
        'Id_Recepteur',
    ];


    public function expediteur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur');
    }


    public function recepteur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Utilisateur_1');
    }
}
