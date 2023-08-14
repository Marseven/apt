<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index()
    {
        return view('admin.member.index');
    }

    public function  ajaxMembers(Request $request)
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
        $totalRecords = Membre::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Membre::select('count(*) as allcount')->where('lastname', 'like', '%' . $searchValue . '%')->orWhere('firstname', 'like', '%' . $searchValue . '%')->orWhere('phone', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Membre::orderBy($columnName, $columnSortOrder)
            ->where('membres.lastname', 'like', '%' . $searchValue . '%')
            ->orWhere('membres.firstname', 'like', '%' . $searchValue . '%')
            ->orWhere('membres.phone', 'like', '%' . $searchValue . '%')
            ->select('membres.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $i = 1;

        foreach ($records as $record) {

            $id = $i;

            $name = $record->firstname . ' ' . $record->lastname;
            $phone = $record->phone;
            $hood = $record->hood;

            $actions = '<a class="btn btn-outline-primary btn-sm modal_view_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView" title="view">
                        <i class="fas fa-eye"></i>
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
                "phone" => $phone,
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

    public function  getMember(Request $request)
    {
        $member = Membre::find($request->id);

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
                    <p class="mb-0">' . $member->hood . '</p>
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
}
