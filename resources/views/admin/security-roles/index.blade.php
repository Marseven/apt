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

    <!-- Bootstrap Css -->
@endpush

@section('content')
    <!-- ========== table components start ========== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Liste des Rôles</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Rôles</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">

                                <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-2"
                                    data-bs-toggle="modal" data-bs-target="#securityModal"><i class="mdi mdi-plus me-1"></i>
                                    Ajouter</button>

                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Espace</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        @php
                                            $role->load(['object']);
                                        @endphp
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->object ? $role->object->name : 'NULL' }}</td>
                                            <td>
                                                <button class="btn btn-xs btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#cardModalView{{ $role->id }}">Voir</button>
                                                <button class="btn btn-xs btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#cardModal{{ $role->id }}">Modifer</button>
                                                <button class="btn btn-xs btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cardModalCenter{{ $role->id }}">
                                                    Supprimer
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- ========== table components end ========== -->

    @foreach ($roles as $role)
        <div class="modal fade" id="cardModalView{{ $role->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelOne" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">{{ $role->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="lni lni-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mb-3">
                            <table class="table text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th class="w-75">Permissions du rôle</th>
                                        <th><i class="fa fa-eye"></i></th>
                                        <th><i class="fa fa-plus"></i></th>
                                        <th><i class="fa fa-edit"></i></th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rolepermissions as $permission)
                                        @if ($permission->security_role_id == $role->id)
                                            <tr>

                                                <td class="border-top-0">
                                                    {{ $permission->name }}
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox"
                                                            {{ $permission->look == 'on' ? 'checked' : '' }} disabled
                                                            class="form-check-input" id="customCheckOne">
                                                        <label class="form-check-label" for="customCheckOne"></label>
                                                    </div>
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox"
                                                            {{ $permission->creat == 'on' ? 'checked' : '' }} disabled
                                                            class="form-check-input" id="customCheckOne">
                                                        <label class="form-check-label" for="customCheckOne"></label>
                                                    </div>
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox"
                                                            {{ $permission->updat == 'on' ? 'checked' : '' }} disabled
                                                            class="form-check-input" id="customCheckTwo">
                                                        <label class="form-check-label" for="customCheckTwo"></label>
                                                    </div>
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox"
                                                            {{ $permission->del == 'on' ? 'checked' : '' }} disabled
                                                            class="form-check-input" id="customCheckThree">
                                                        <label class="form-check-label" for="customCheckThree"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"
                            class="btn btn-primary">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($roles as $role)
        <div class="modal fade" id="cardModal{{ $role->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelOne" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">{{ $role->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="lni lni-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/security-permission/edit/' . $role->id) }}" method="POST">
                            @csrf
                            <div class="table-responsive mb-3">
                                <table class="table text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="w-75">Permissions du rôle</th>
                                            <th><i class="fa fa-eye"></i></th>
                                            <th><i class="fa fa-plus"></i></th>
                                            <th><i class="fa fa-edit"></i></th>
                                            <th><i class="fa fa-trash"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td class="border-top-0">
                                                    {{ $permission->name }}
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox" name="{{ $permission->name }}-view"
                                                            class="form-check-input" id="customCheckOne">
                                                        <label class="form-check-label" for="customCheckOne"></label>
                                                    </div>
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox" name="{{ $permission->name }}-create"
                                                            class="form-check-input" id="customCheckOne">
                                                        <label class="form-check-label" for="customCheckOne"></label>
                                                    </div>
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox" name="{{ $permission->name }}-edit"
                                                            class="form-check-input" id="customCheckTwo">
                                                        <label class="form-check-label" for="customCheckTwo"></label>
                                                    </div>
                                                </td>
                                                <td class="border-top-0">
                                                    <div class="form-check ">
                                                        <input type="checkbox" name="{{ $permission->name }}-delete"
                                                            class="form-check-input" id="customCheckThree">
                                                        <label class="form-check-label" for="customCheckThree"></label>
                                                    </div>
                                                </td>
                                                <input type="hidden" name="role" value="{{ $role->id }}">
                                                <input type="hidden" name="{{ $permission->name }}-permission"
                                                    value="{{ $permission->id }}">

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" style="background-color: #2b9753 !important;"
                            class="btn btn-primary">Enregistrer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="securityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un rôle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="lni lni-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/security-role') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Libellé</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="security_object_id" class="col-form-label">Espace</label>
                            <select id="selectOne" class="form-control" name="security_object_id">
                                @foreach ($objects as $object)
                                    <option value="{{ $object->id }}">{{ $object->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #2b9753 !important;"
                        class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($roles as $role)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $role->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="lni lni-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce rôle ?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger">Supprimer</button>
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
            $('#datatable-buttons').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                }
            });
        });
    </script>
@endpush
