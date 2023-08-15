<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    use HasFactory;

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    // Dans le modèle Candidat
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
