<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id');
    }

    public function desk()
    {
        return $this->belongsTo(Desk::class, 'desk_id');
    }

    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id');
    }
}
