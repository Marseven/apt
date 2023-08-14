<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Entreprise;
use App\Models\School;
use App\Models\SecurityRole;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function profil(User $user)
    {
        $user = Auth::user();
        $role = SecurityRole::find($user->security_role_id);
        $role->load(['object']);
        Log::info('Afficher le profil de ' . Auth::user()->name);
        return view('admin.users.profil', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function admin(User $user)
    {
        $users = User::where('security_role_id', '<=', 2)->get();
        $roles = SecurityRole::all();
        $user->load(
            ['SecurityRole']
        );

        return view('admin.users.list', ['users' => $users,'roles' => $roles,]);
    }

    public function customer(User $user)
    {
        return view('admin.users.customer');
    }

    public function ajaxCustomers(Request $request)
    {
        BasicController::he_can('Payments', 'look');


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
        $totalRecords = User::select('count(*) as allcount')->where('security_role_id', null)->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('security_role_id', null)->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName, $columnSortOrder)
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $picture = $record->picture;

            $name = ' <td>
                    <a class="contact-tab-1 nav-link modal_view_action"
                        id="v-pills-profile-tab"
                        data-bs-toggle="pill"
                        href="#v-pills-user"
                        data-id="' . $record->id . '"
                        role="tab"
                        aria-controls="v-pills-profile"
                        aria-selected="false">
                        <div class="media"><img
                                class="img-50 img-fluid m-r-20 rounded-circle update_img_0"
                                src="' . asset($picture ? $picture : 'media/users/blank.png') . '"
                                alt="">
                            <div class="media-body">
                                <h6><span
                                        class="last_name_0">' . $record->name . '</span>
                                </h6>
                                <p class="email_add_0">
                                ' . $record->email . '
                                </p>
                            </div>
                        </div>
                    </a>
                </td>';

            $data_arr[] = array(
                "name" => $name,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        Log::info('Afficher la liste de utilisateurs à ' . Auth::user()->name);

        return response()->json($response);
    }

    public function getCustomer(Request $request)
    {

        $user = User::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {

            $body = '
            <div class="profile-mail">
                <div class="media"><img
                        class="img-100 img-fluid m-r-20 rounded-circle update_img_0"
                        src="' . asset($user->picture ? $user->picture : 'media/users/blank.png') . '"
                        alt="">
                    <input class="updateimg" type="file"
                        name="img"
                        onchange="readURL(this,' . $user->id . ')"
                        data-bs-original-title=""
                        title="">
                    <div class="media-body mt-0">
                        <h5><span
                                class="last_name_0">' . $user->name . '</span>
                        </h5>
                        <p class="email_add_0">
                        ' . $user->email . '
                        </p>';
            if (Auth::user()->security_role_id == 1) {
                $body .= ' <ul>
                                <li><a href="#"
                                class="modal_edit_action"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cardModal' . $user->id . '"
                                        data-bs-original-title=""
                                        data-id="' . $user->id . '"
                                        title="">Rôle</a>
                                </li>
                                <li><a href="#"
                                class="modal_edit_ctn_action"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cardModalEdit' . $user->id . '"
                                        data-bs-original-title=""
                                        data-id="' . $user->id . '"
                                        title="">Modifier</a>
                                </li>
                                <li><a href="#"
                                class="modal_delete_action"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cardModalCenter' . $user->id . '"
                                        data-bs-original-title=""
                                        data-id="' . $user->id . '"
                                        title="">Supprimer</a>
                                </li>

                            </ul>';
            }
            $body .= '</div>
                </div>
                <div class="email-general">
                    <h6 class="mb-3">Informations</h6>
                    <ul>
                        <li>Nom Complet <span
                                class="font-primary first_name_0">' . $user->name . '</span>
                        </li>

                        <li>Téléphone<span
                                class="font-primary mobile_num_0">' . $user->phone . '</span>
                        </li>
                        <li>Email <span
                                class="font-primary email_add_0">' . $user->email . '
                            </span></li>

                    </ul>
                </div>
            </div>';
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le rôle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form action="' .  url('admin/admin-userrole/' . $request->id . '') . '" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Rôle</label>
                        <select id="selectOne" class="form-control" name="security_role_id">';
            $roles = SecurityRole::all();
            foreach ($roles as $role) {
                $body .= '<option value="' . $role->id . '">' . $role->name . '</option>';
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
            <form method="POST" action="' . url('admin/admin-user/' . $request->bank . '/' . $request->id . '') . '">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="delete" value="true">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

    public function editCustomer(Request $request)
    {
        $title = "";
        $body = "";

        if ($request->action == "edit") {

            $user = User::find($request->id);
            $body = '<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour  ' . $user->name . '</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>

                <form action="' .  url('admin/admin-user/' . $user->id . '') . '" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="' . csrf_token() . '">

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nom & Prénom</label>
                            <input type="text" name="name" class="form-control" value="' . $user->name . '">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="' . $user->phone . '">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="' . $user->email . '">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

    public function register()
    {
        BasicController::he_can('Users', 'creat');
        $roles = SecurityRole::all();
        return view('admin.users.add', [
            'roles' => $roles,
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $email_exist = User::where('email', $request->email)->count();
        if ($email_exist > 0) {
            return back()->with('error', "Cette email existe déjà.")->withInput();
        } else {
            $user->email = $request->email;
        }
        if (BasicController::formatPhone($request->phone) != false) {
            $user->phone = BasicController::formatPhone($request->phone);
        } else {
            return back()->withErrors("Numéro de Téléphone incorrect");
        }
        $user->security_role_id = $request->security_role_id;

        if ($request->file('picture')) {
            $picture = FileController::picture($request->file('picture'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $user->picture = $picture['url'];
        }

        $user->save();
        Log::info('Creation de l\'utilisateur id: ' . $user->id . ' par ' . Auth::user()->name);
        return redirect('admin/list-users');
    }

    public function update(Request $request, User $user)
    {
        if (isset($_POST['delete'])) {
            $id = $user->id;
            if ($user->delete()) {
                Log::info('Suppression de l\'utilisateur id: ' . $id . ' par ' . Auth::user()->name);
                return back()->with('success', "L'utilisateur a été supprimé.");
            } else {
                return back()->with('error', "L'utilisateur  n'a pas été supprimé.");
            }
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            if (BasicController::formatPhone($request->phone) != false) {
                $user->phone = BasicController::formatPhone($request->phone);
            } else {
                return back()->withErrors("Numéro de Téléphone incorrect");
            }

            if ($request->file('picture')) {
                $picture = FileController::picture($request->file('picture'));
                if ($picture['state'] == false) {
                    return back()->withErrors($picture['message']);
                }

                $user->picture = $picture['url'];
            }

            $user->save();
            Log::info('Modification de l\'utilisateur id: ' . $user->id . ' par ' . Auth::user()->name);
            return back()->with('success', "L'utilisateur a été mis à jour.");
        }
    }

    public function updateRole(Request $request, User $user)
    {

        $user->security_role_id = $request->security_role_id;

        $user->save();

        Log::info('Mise à jour du Rôle de l\'utilisateur id: ' . $user->id . ' par ' . Auth::user()->name);
        return redirect('admin/list-customer')->with('success', "Le rôle du de l'utilisateur a été modifié avec succès.");
    }

    public function updatePassword(Request $request, User $user)
    {
        $user->password = Hash::make($request->password);
        $user->save();
        Log::info('Modification du mot de passe de l\'utilisateur id: ' . $user->id . ' par ' . Auth::user()->name);
        return redirect('/admin-profil');
    }
}
