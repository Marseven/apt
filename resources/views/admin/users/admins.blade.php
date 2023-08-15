@extends('layouts.admin')

@push('styles')
    <!-- DataTables -->
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Liste des Administrateurs</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Administrateurs</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12" align="right">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#inlineForm">
                                <i class="fa fa-plus"></i> Créer un administrateur
                            </button>
                        </div>
                    </div>
                    <br>
                    <!-- Card -->
                    <div class="card">
                        <!-- Tab content -->
                        <div class="tab-content p-4" id="pills-tabContent-table">
                            <div class="tab-pane tab-example-design fade show active" id="pills-table-design"
                                role="tabpanel" aria-labelledby="pills-table-design-tab">
                                <!-- Basic table -->
                                <div class="table-responsive">
                                    <table class="table" id="gt_datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom complet</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th>Rôle</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone ?? '' }}</td>
                                                    <td>{{ $user->SecurityRole ? $user->SecurityRole->name : 'Client' }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#cardModalView{{ $user->id }}"><i
                                                                class="fa fa-eye"></i></button>
                                                        <button type="button" class="btn btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#cardModal{{ $user->id }}"><i
                                                                class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#cardModalCenter{{ $user->id }}">
                                                            Supprimer
                                                        </button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Basic table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ajouter un Administrateur</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('admin/create-user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center mb-8">
                            <div class="col-md-3 mb-3 mb-md-0">
                                <label class="mb-0">Photo de profil</label>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img style="height: auto;width: 5em;margin: 10px;"
                                            src="{{ asset('front/images/default.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        <input type="file" class="btn btn-outline-white me-1" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row -->

                        <div class="mb-3 row">
                            <label for="fullName" class="col-sm-4 col-form-label form-label">Nom complet</label>
                            <div class="col-md-8 col-12">
                                <input name="name" ype="text" class="form-control" placeholder="First name"
                                    id="name" required>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label
              form-label">Email</label>
                            <div class="col-md-8 col-12">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    id="email" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email"
                                class="col-sm-4 col-form-label
              form-label">Téléphone</label>
                            <div class="col-md-8 col-12">
                                <input type="tel" class="form-control" name="phone" placeholder="Téléphone"
                                    id="phone" required>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label
                form-label">Rôle</label>
                            <div class="col-md-8 col-12">
                                <select id="selectOne" class="form-control" name="security_role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Fermer</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <div class="modal fade text-left" id="cardModal{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Mettre à jour l'administrateur</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ url('admin/update-user/' . $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row align-items-center mb-8">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <label class="mb-0">Photo de profil</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="{{ $user->picture ? $user->picture : asset('front/images/default.jpg') }}"
                                                style="height: auto;width: 5em;margin: 10px;" alt="">
                                        </div>
                                        <div>
                                            <input value="{{ $user->picture }}" name="picture" type="file"
                                                class="btn btn-outline-white me-1" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="fullName" class="col-sm-4 col-form-label form-label">Nom complet</label>
                                <div class="col-md-8 col-12">
                                    <input name="name" type="text" class="form-control" placeholder="Nom Complet"
                                        id="name" value="{{ $user->name }}" required>
                                </div>
                            </div>

                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-4 col-form-label form-label">Email</label>
                                <div class="col-md-8 col-12">
                                    <input type="email" value="{{ $user->email }}" class="form-control"
                                        name="email" placeholder="Email" id="email" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-4 col-form-label form-label">Téléphone</label>
                                <div class="col-md-8 col-12">
                                    <input type="tel" value="{{ $user->phone }}" class="form-control"
                                        name="phone" placeholder="Téléphone" id="phone" required>
                                </div>
                            </div>

                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="email"
                                    class="col-sm-4 col-form-label
                    form-label">Rôle</label>
                                <div class="col-md-8 col-12">
                                    <select id="selectOne" class="form-control" name="security_role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Fermer</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Enregistrer</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($users as $user)
        <div class="modal fade" id="cardModalView{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">{{ $user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-5" style="text-align: center">
                                <img src="{{ $user->picture ? $user->picture : asset('front/images/default.jpg') }}"
                                    style="height: auto;width: 7em;" alt="">
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Nom </h6>
                                <p class="mb-0">{{ $user->name }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Email
                                </h6>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Téléhone
                                </h6>
                                <p class="mb-0">{{ $user->phone }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Rôle
                                </h6>
                                @php
                                    $user->load(['SecurityRole']);
                                @endphp
                                <p class="mb-0">{{ $user->SecurityRole->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Fermer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($users as $user)
        <!-- Modal -->

        <div class="modal fade" id="cardModalCenter{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Fermer</span>
                        </button>
                        <form method="POST" action="{{ url('admin/update-user/' . $user->id) }}">
                            @csrf
                            <input type="hidden" name="delete" value="true">
                            <button type="submit" class="btn btn-danger ml-1">
                                <i class="bi bi-trash d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Supprimer</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->


    <!--end::Page Vendors-->

    <script>
        $(document).ready(function() {
            $('#gt_datatable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                }
            });
        });
    </script>
@endpush
