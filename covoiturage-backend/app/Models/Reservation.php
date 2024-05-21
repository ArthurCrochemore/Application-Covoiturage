<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'Reservation';

    protected $primaryKey = 'Id_Reservation';

    public $timestamps = false;

    protected $fillable = [
        'Date_Reservation',
        'Statut',
        'Id_Passager',
        'Id_Trajet',
        'Id_Adresse',
    ];

    public function utilisateur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'Id_Passager');
    }

    public function trajet(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trajet::class, 'Id_Trajet');
    }
    public function adresse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trajet::class, 'Id_Adresse');
    }

    /**
     * @return bool
     */
    public function isTimestamps(): bool
    {
        return $this->timestamps;
    }


}
