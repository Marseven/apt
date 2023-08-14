<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Mail\DemandeMessage;
use App\Mail\RegistrationMessage;
use Swift_TransportException;
use App\Models\Entreprise;
use App\Models\Membre;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Registration;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\SecurityObject;
use App\Models\SecurityPermission;
use App\Models\SecurityRole;
use PDF;
use setasign\Fpdi\Fpdi;

class WelcomeController extends BasicController
{
    public function __construct()
    {
    }

    //
    public function index()
    {
        return view('front.form');
    }

    public function register(Request $request)
    {
        $exist = Membre::where('phone',  $request->phone)->first();
        if ($exist != null) {
            $member = $exist;
        } else {
            $member = new Membre();
        }

        $member->lastname = $request->lastname;
        $member->firstname = $request->firstname;
        $member->phone = $request->phone;
        $member->hood = $request->hood;

        if ($member->save()) {
            return back()->with('success', "Merci pour votre inscription.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }
}
