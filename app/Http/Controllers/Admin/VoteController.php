<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Desk;
use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    //

    public function index()
    {
        $desks = Desk::all();
        $elections = Election::all();
        $candidats = Candidat::all();
        return view('admin.vote.index', compact('desks', 'candidats', 'elections'));
    }

    public function details(Desk $desk)
    {
        $desks = Desk::all();
        $elections = Election::all();
        $candidats = Candidat::all();
        return view('admin.vote.details', compact('desk', 'desks', 'candidats', 'elections'));
    }

    public function  ajaxVotes(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Desk::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Desk::select('count(*) as allcount')->where('label', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Desk::orderBy($columnName, $columnSortOrder)
            ->where('desks.label', 'like', '%' . $searchValue . '%')
            ->select('desks.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $id = $record->id;
            $label = '<a href="' . url('admin/delais/' . $record->id . '') . '">' . $record->label . '</a>';

            $record_cand =  Desk::where('id', $record->id)->with('bestCandidatVote')->first();

            $candidat = $record_cand->bestCandidatVote->first();

            if ($candidat) {
                $nom = $candidat->lastname; // Nom du candidat
                $prenom = $candidat->firstname; // Prénom du candidat

                $totalVotes = Vote::where('desk_id', $record->id)->sum('vote');

                if ($totalVotes != 0) {
                    $maxVote = ($candidat->max_vote / $totalVotes) * 100;
                }
            }

            //dd($candidat);

            $actions = '<a class="btn btn-outline-primary btn-sm" href="' . url('admin/details/' . $record->id . '') . '">Détails</a>';

            $data_arr[] = array(
                "id" => $id,
                "label" => $label,
                "candidat" => $candidat ? $prenom . ' ' . $nom : "Aucun Candidat",
                "score" => $candidat ? $maxVote . '%' : "0%",
                "actions" => $actions,
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function  ajaxCandidatVote(Request $request, $desk)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Candidat::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Candidat::select('count(*) as allcount')->where('firstname', 'like', '%' . $searchValue . '%')->orWhere('lastname', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Candidat::orderBy($columnName, $columnSortOrder)
            ->where('candidats.firstname', 'like', '%' . $searchValue . '%')
            ->orWhere('candidats.lastname', 'like', '%' . $searchValue . '%')
            ->select('candidats.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $record) {

            $id = $record->id;
            $candidat = $record->firstname . ' ' . $record->lastname;

            $record->load(['vote' => function ($query) use ($desk) {
                $query->where('desk_id', $desk);
            }]);

            $pourcent = 0;

            $totalVotes = Vote::where('desk_id', $record->id)->sum('vote');
            $vote = $record->vote->first();

            if ($totalVotes != 0 && $vote) {
                $pourcent = ($vote->vote / $totalVotes) * 100;
            }

            if ($vote) {
                $actions = '<a class="btn btn-outline-primary btn-sm modal_edit_action" data-bs-toggle="modal"
                data-id="' . $record->id . '"
                data-bs-target="#cardModal" title="edit">
                <i class="fas fa-edit"></i>
            </a>';
            } else {
                $actions = '<a class="btn btn-outline-success btn-sm modal_edit_action" data-bs-toggle="modal" data-bs-target="#cardModalAdd" title="edit">
            <i class="fas fa-plus"></i>
        </a>';
            }


            $data_arr[] = array(
                "id" => $id,
                "candidat" => $candidat,
                "score" => $vote->vote ?? 0,
                "pourcent" => $pourcent . '%',
                "actions" => $actions,
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function  getVote(Request $request)
    {
        $vote = Vote::where('candidat_id', $request->id)->where('desk_id', $request->desk)->first();

        $title = "";
        $body = "";

        if ($request->action == "edit") {

            $body = '<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le résultat N° : ' . $vote->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' .  url('admin/create/' . $request->id . '') . '" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="desk_id" value="' . $request->desk . '">
                    <input type="hidden" name="candidat_id" value="' . $request->id . '">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nombre de votes</label>
                    <input type="number" class="form-control" name="vote" value="' . $vote->vote . '" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>';
        } else {

            $body = '
            <form method="POST" action="' . url('admin/delete/member/' . $request->id . '') . '">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="delete" value="true">
                <button style="background-color: #d50100 !important;" class="btn btn-danger" type="submit">Supprimer</button>
            </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

    public function create(Request $request)
    {

        $vote = Vote::where('candidat_id', $request->candidat_id)->where('desk_id', $request->desk_id)->first();

        if ($vote) {
            return back()->with('error', "Ce candidat a déjà un résutat dans ce bureau de vote.");
        }

        $vote = new Vote();

        $vote->vote = $request->vote;
        $vote->candidat_id = $request->candidat_id;
        $vote->election_id = $request->election_id;
        $vote->desk_id = $request->desk_id;
        $vote->user_id = Auth::user()->id;

        if ($vote->save()) {
            return back()->with('success', "Le résultat a bien été enregistré.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function update(Request $request, Vote $vote)
    {
        if (isset($_POST['delete'])) {
            if ($vote->delete()) {
                return back()->with('success', "Le résultat a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $candidat = Candidat::find($request->candidat_id);
            $vote->vote = $request->vote;
            $vote->candidat_id = $request->candidat_id;
            $vote->election_id = $candidat->election_id;
            $vote->desk_id = $request->desk_id;

            if ($vote->save()) {
                return back()->with('success', "Le résultat a bien été mise à jour.");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }

    public function selectData(Request $request)
    {
        if ($request->target == 'candidat') {
            $organization = Candidat::where('election_id', $request->id)->get();
            $response = json_encode($organization);
            return response()->json($response);
        }
    }
}
