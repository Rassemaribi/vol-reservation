<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompagnieAerienne extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom','contry','logo'
        ];

        public function vols()
        {
            return $this->hasMany(Vol::class, 'compagnieaerienneID');
        }
}
