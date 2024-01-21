<?php

namespace App\Models;
use App\Models\CompagnieAerienne;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_vol','from','to','date_depart','date_arrivee','prix','capacite','compagnieaerienneID'
        ];
        public function compagnieAerienne()
        {
            return $this->belongsTo(CompagnieAerienne::class, 'compagnieaerienneID');
        }
        
        public function reservation()
    {
        return $this->belongsTo(Reservation::class,'vol_id');
    }
}
