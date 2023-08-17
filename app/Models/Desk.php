<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Desk extends Model
{
    use HasFactory;

    // Dans le modèle Candidat
    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    public function bestCandidatVote()
    {
        return $this->hasMany(Vote::class)
            ->select('candidat_id', 'desk_id', 'candidats.lastname', 'candidats.firstname', DB::raw('MAX(vote) as max_vote'))
            ->join('candidats', 'votes.candidat_id', '=', 'candidats.id')
            ->groupBy('candidat_id', 'desk_id', 'candidats.lastname', 'candidats.firstname');
    }
}
