@extends('layouts.admin')


@section('content')
    <!-- Container fluid -->
    <div class="container-fluid px-6 py-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div>
                    <div class="border-bottom pb-4 mb-4 ">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0 fw-bold">Profil</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <!-- Bg -->
                <div class="pt-20 rounded-top"
                    style="background:
                                                                                        url({{ asset('images/bg/profile-cover.jpg') }}) no-repeat;
                                                                                        background-size: cover;">
                </div>
                <div class="bg-white rounded-bottom smooth-shadow-sm ">
                    <div class="d-flex align-items-center justify-content-between
              pt-4 pb-6 px-4">
                        <div class="d-flex align-items-center">
                            <!-- avatar -->
                            <div
                                class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                                <img src="{{ asset($user->picture ? $user->picture : asset('front/images/default.jpg')) }}"
                                    style="height: auto;width: 7em; margin : 10px;" alt="">
                            </div>
                            <!-- text -->
                            <div class="lh-1">
                                <h2 class="mb-0">{{ $user->name }}
                                    <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip"
                                        data-placement="top" title="" data-original-title="Beginner">

                                    </a>
                                </h2>
                                <p class="mb-0 d-block">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-primary d-none d-md-block" data-bs-toggle="modal"
                                data-bs-target="#userModal">Mettre à jour</button>
                            <br>
                            <button type="button" class="btn btn-outline-warning d-none d-md-block" data-bs-toggle="modal"
                                data-bs-target="#passwordModal">Changer le mot de passe</button>
                        </div>
                    </div>
                    <!-- nav -->
                    <br>
                </div>
            </div>
        </div>
        <br>
        <!-- content -->
        <div class="py-6">
            <!-- row -->
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6">
                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- card title -->
                            <h4 class="card-title mb-4">Mes Informations</h4>
                            <!-- row -->
                            <div class="row">
                                <div class="col-6 mb-5">
                                    <!-- text -->
                                    @php
                                        $user->load(['SecurityRole']);
                                    @endphp
                                    <h6 class="text-uppercase fs-5 ls-2">Rôle
                                    </h6>
                                    <p class="mb-0">{{ $role->name }}</p>
                                </div>
                                <div class="col-6 mb-5">
                                    <!-- text -->
                                    @if ($user->taux != null)
                                        <h6 class="text-uppercase fs-5 ls-2">Taux d'intérêt
                                        </h6>
                                        <p class="mb-0">{{ $user->taux }}%</p>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <h6 class="text-uppercase fs-5 ls-2">Email </h6>
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-uppercase fs-5 ls-2">Espace
                                    </h6>
                                    <p class="mb-0">{{ $role->object->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6">
                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- card title -->
                            <h4 class="card-title mb-4">Dernières activités</h4>
                            <div class="d-md-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <!-- text -->
                                    <div class="ms-3 ">
                                        <h5 class="mb-1"><a href="#" class="text-inherit">Aucune Activité</a>
                                        </h5>
                                        <p class="mb-0 fs-5 text-muted">Pour le moment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/admin-user/' . $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">Nom Complet</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Téléphone</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin/admin-userpassword/' . $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Ancien mot de passe</label>
                            <input type="password" class="form-control" name="lastpassword">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Confirmé le mot de passe</label>
                            <input type="password" class="form-control" name="password_confirmed">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
