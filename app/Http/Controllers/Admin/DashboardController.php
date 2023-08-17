<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Front\WelcomeController;
use App\Models\Atelier;
use App\Models\Candidat;
use App\Models\Desk;
use App\Models\Election;
use App\Models\Entreprise;
use App\Models\Membre;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;
use setasign\Fpdi\Fpdi;

class DashboardController extends BasicController
{
    //
    public function dashboard()
    {
        $nb_member = Membre::all()->count();
        $nb_desks = Desk::all()->count();
        $nb_candidat = Candidat::all()->count();

        $results = [];
        $i = 0;

        $elections = Election::all();

        foreach ($elections as $el) {
            $results[$i]['label'] = $el->label;

            $candidats = Candidat::where('election_id', $el->id)->with(['vote' => function ($query) use ($el) {
                $query->where('election_id', $el->id);
            }])->get();
            $results[$i]['candidats'] = $candidats;
            $desks = Desk::withSum(['vote' => function ($query) use ($el) {
                $query->where('election_id', $el->id);
            }], 'votes.vote')
                ->get();
            $results[$i]['desks'] = $desks;
            $i++;
        }




        return view('admin.dashboard', [
            'nb_member' => $nb_member,
            'nb_desks' => $nb_desks,
            'nb_candidat' => $nb_candidat,
            'results' => $results,
        ]);
    }
}
