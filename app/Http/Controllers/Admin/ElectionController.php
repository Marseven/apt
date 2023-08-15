<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desk;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    //
    public function index()
    {
        return view('admin.election.index');
    }

    public function  ajaxElections(Request $request)
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
        $totalRecords = Election::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Election::select('count(*) as allcount')->where('label', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Election::orderBy($columnName, $columnSortOrder)
            ->where('elections.label', 'like', '%' . $searchValue . '%')
            ->select('elections.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $i = 1;

        foreach ($records as $record) {

            $id = $i;

            $label = $record->label;
            $date = $record->date_election;

            $actions = '<a class="btn btn-outline-primary btn-sm modal_view_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView" title="view">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-sm modal_edit_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModal" title="view">
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
                "label" => $label,
                "date" => $date,
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

    public function  getElection(Request $request)
    {
        $election = Election::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {

            $title = "Election N° " . $election->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Titre</h6>
                    <p class="mb-0">' . $election->label . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de l\'élection
                    </h6>
                    <p class="mb-0">' . $election->phone . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $election->created_at . '</p>
                </div>
            </div>';
        } elseif ($request->action == "edit") {

            $title = "Partisan N° " . $election->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom Complet</h6>
                    <p class="mb-0">' . $election->firstname . ' ' . $election->lastname . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone
                    </h6>
                    <p class="mb-0">' . $election->phone . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Quartier </h6>
                    <p class="mb-0">' . $election->hood . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $election->created_at . '</p>
                </div>
            </div>';
        } else {

            $body = '
            <form method="POST" action="' . url('admin/delete/election/' . $request->id . '') . '">
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
        $election = new Election();

        $election->label = $request->label;
        $election->date_election = $request->date_election;

        if ($election->save()) {
            return back()->with('success', "L'élection a bien été créé.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function update(Request $request, Election $election)
    {
        if (isset($_POST['delete'])) {
            if ($election->delete()) {
                return back()->with('success', "L'élection a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $election->label = $request->label;
            $election->date_election = $request->date_election;

            if ($election->save()) {
                return back()->with('success', "L'élection a bien été mise à jour.");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }

    public function desks()
    {
        return view('admin.desk.index');
    }

    public function  ajaxDesks(Request $request)
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

        $i = 1;

        foreach ($records as $record) {

            $id = $i;

            $label = $record->label;
            $hood = $record->hood;

            $actions = '<a class="btn btn-outline-primary btn-sm modal_view_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView" title="view">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-sm modal_edit_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModal" title="view">
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
                "label" => $label,
                "hood" => $hood,
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

    public function  getDesk(Request $request)
    {
        $desk = Desk::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {

            $title = "Bureau N° " . $desk->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom Complet</h6>
                    <p class="mb-0">' . $desk->firstname . ' ' . $desk->lastname . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone
                    </h6>
                    <p class="mb-0">' . $desk->phone . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Quartier </h6>
                    <p class="mb-0">' . $desk->hood . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $desk->created_at . '</p>
                </div>
            </div>';
        } else {

            $body = '
            <form method="POST" action="' . url('admin/delete/desk/' . $request->id . '') . '">
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

    public function createDesk(Request $request)
    {
        $desk = new Desk();

        $desk->label = $request->label;
        $desk->hood = $request->hood;

        if ($desk->save()) {
            return back()->with('success', "Le bureau a bien été créé.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function updateDesk(Request $request, Desk $desk)
    {
        if (isset($_POST['delete'])) {
            if ($desk->delete()) {
                return back()->with('success', "Le candidat a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $desk->label = $request->label;
            $desk->hood = $request->hood;

            if ($desk->save()) {
                return back()->with('success', "Le bureau a bien été mise à jour.");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }
}
