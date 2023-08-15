<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Desk;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    //

    public function index()
    {
        $desks = Desk::all();
        $candidats = Candidat::all();
        return view('admin.vote.index', compact('desks', 'candidats'));
    }

    public function details()
    {
        $desks = Desk::all();
        $candidats = Candidat::all();
        return view('admin.vote.details', compact('desks', 'candidats'));
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
        $totalRecordswithFilter = Desk::select('count(*) as allcount')->where('label', 'like', '%' . $searchValue . '%')->orWhere('hood', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Desk::orderBy($columnName, $columnSortOrder)
            ->where('desks.label', 'like', '%' . $searchValue . '%')
            ->orWhere('desks.hood', 'like', '%' . $searchValue . '%')
            ->select('desks.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $id = $record->id;
            $label = '<a href="' . url('admin/delais/' . $record->id . '') . '">' . $record->label . '</a>';
            $hood = $record->hood;

            $actions = '<a class="btn btn-outline-primary btn-sm" href="' . url('admin/delais/' . $record->id . '') . '">Détails</a>';

            $data_arr[] = array(
                "id" => $id,
                "label" => $label,
                "hood" => $hood,
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
        $member = Desk::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {

            $title = "Partisan N° " . $member->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom Complet</h6>
                    <p class="mb-0">' . $member->firstname . ' ' . $member->lastname . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone
                    </h6>
                    <p class="mb-0">' . $member->phone . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Quartier </h6>
                    <p class="mb-0">' . $member->country . ' XAF</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $member->created_at . '</p>
                </div>
            </div>';
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
        $vote = new Vote();

        $vote->label = $request->label;
        $vote->date_election = $request->date_election;

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
            $vote->label = $request->label;
            $vote->date_election = $request->date_election;

            if ($vote->save()) {
                return back()->with('success', "Le résultat a bien été mise à jour.");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }
}
