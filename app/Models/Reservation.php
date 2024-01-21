<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_passager', 'classe_vol', 'nombre_sieges', 'prix_total', 'vol_id'
    ];

    // Relation avec le modèle Vol
    public function vol()
    {
        return $this->belongsTo(Vol::class,'vol_id');
    }
}
