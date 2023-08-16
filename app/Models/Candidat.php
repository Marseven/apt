<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id');
    }

    public function vote()
    {
        return $this->hasMany(Vote::class, 'candidat_id');
    }
}
