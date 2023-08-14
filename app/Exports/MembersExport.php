<?php

namespace App\Exports;

use App\Models\Membre;
use App\Models\Registration;
use App\Models\RequestCard;
use App\Models\RequestCardEcobank;
use App\Models\RequestCardUba;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MembersExport implements FromView
{

    public function __construct()
    {
    }

    public function view(): View
    {
        $members = Membre::all();
        return view('admin.exports.member', [
            'members' => $members,
        ]);
    }
}
