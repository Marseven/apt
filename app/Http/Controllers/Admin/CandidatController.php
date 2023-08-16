<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Candidat;
use App\Models\Election;
use App\Models\Membre;
use Illuminate\Http\Request;
use Termwind\Components\Element;

class CandidatController extends Controller
{
    //

    public function index()
    {
        $elections = Election::all();
        return view('admin.candidat.index', compact('elections'));
    }

    public function  ajaxCandidats(Request $request)
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
        $totalRecordswithFilter = Candidat::select('count(*) as allcount')->where('lastname', 'like', '%' . $searchValue . '%')->orWhere('firstname', 'like', '%' . $searchValue . '%')->orWhere('parti', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Candidat::orderBy($columnName, $columnSortOrder)
            ->where('candidats.lastname', 'like', '%' . $searchValue . '%')
            ->orWhere('candidats.firstname', 'like', '%' . $searchValue . '%')
            ->orWhere('candidats.parti', 'like', '%' . $searchValue . '%')
            ->select('candidats.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $i = 1;

        foreach ($records as $record) {

            $id = $i;

            $record->load(['election']);

            $name = $record->firstname . ' ' . $record->lastname;
            $parti = $record->parti;
            $election = $record->election->label;

            $actions = '<a class="btn btn-outline-primary btn-sm modal_view_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView" title="view">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-sm modal_edit_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModal" title="edit">
                        <i class="fas fa-edit"></i>
                    </a>';

            $actions .= '
                <a class="btn btn-outline-danger btn-sm modal_delete_action" data-bs-toggle="modal"
                data-id="' . $record->id . '"
                data-bs-target="#cardModalCenter" title="Delete">
                <i class="fas fa-trash"></i>
            </a>';


            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "parti" => $parti,
                "election" => $election,
                "actions" => $actions,
            );

            $i++;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function  getCandidat(Request $request)
    {
        $candidat = Candidat::find($request->id);

        $candidat->load(['election']);

        $title = "";
        $body = "";

        if ($request->action == "view") {

            $title = "Candidat N° " . $candidat->id;
            $body = '<div class="row">


                <div class="col-12 mb-5" style="text-align: center">
                    <img src="' . asset($candidat->picture) . '" alt="Akanda Pour Tous" style="height: auto;width: 7em;" alt="">
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Nom Complet</h6>
                    <p class="mb-0">' . $candidat->firstname . ' ' . $candidat->lastname . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Parti Politique
                    </h6>
                    <p class="mb-0">' . $candidat->parti . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Élection </h6>
                    <p class="mb-0">' . $candidat->election->label . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $candidat->created_at . '</p>
                </div>
            </div>';
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le candidat N° : ' . $candidat->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' .  url('admin/candidat/' . $request->id . '') . '" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Photo</label>
                    <input type="file" class="form-control" name="picture" value="' . $candidat->picture . '">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nom</label>
                    <input type="text" class="form-control" name="lastname" value="' . $candidat->lastname . '" required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Prénom</label>
                    <input type="text" class="form-control" name="firstname" value="' . $candidat->firstname . '" required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Parti Politique</label>
                    <input type="text" class="form-control" name="parti" value="' . $candidat->parti . '">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Élection</label>
                <select id="selectOne" class="form-control" name="election_id" required>';
            $elections = Election::all();
            foreach ($elections as $election) {
                $body .= '<option value="' . $election->id . '">' . $election->label . '</option>';
            }

            $body .= '</select>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>';
        } else {

            $body = '
            <form method="POST" action="' . url('admin/delete/candidat/' . $request->id . '') . '">
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
        $candidat = new Candidat();

        $candidat->lastname = $request->lastname;
        $candidat->firstname = $request->firstname;
        $candidat->parti = $request->parti;
        $candidat->election_id = $request->election_id;

        $picture = FileController::picture($request->file('picture'));
        if ($picture['state'] == false) {
            return back()->with('error', $picture['message']);
        }

        $candidat->picture = $picture['url'];

        if ($candidat->save()) {
            return back()->with('success', "Le candidat a bien été créé.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function update(Request $request, Candidat $candidat)
    {
        if (isset($_POST['delete'])) {
            if ($candidat->delete()) {
                return back()->with('success', "Le candidat a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $candidat->lastname = $request->lastname;
            $candidat->firstname = $request->firstname;
            $candidat->parti = $request->parti;
            $candidat->election_id = $request->election_id;

            if ($request->file('picture')) {
                $picture = FileController::picture($request->file('picture'));
                if ($picture['state'] == false) {
                    return back()->with('error', $picture['message']);
                }
                $candidat->picture = $picture['url'];
            }

            if ($candidat->save()) {
                return back()->with('success', "Le candidat a bien été mise à jour.");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }
}
