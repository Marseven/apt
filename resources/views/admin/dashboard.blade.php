@extends('layouts.admin')

@push('styles')
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tableau de Bord</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Tableau de Bord</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Nombre de Partisans</p>
                                            <h4 class="mb-0">{{ $nb_member }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-user font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Nombre Candidats</p>
                                            <h4 class="mb-0">{{ $nb_candidat }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-user font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Nombre de Bureaux de Vote</p>
                                            <h4 class="mb-0">{{ $nb_desks }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-building font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    @foreach ($results as $rs)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Bilan de Vote : {{ $rs['label'] }}</h4>
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="align-middle">Bureau</th>
                                                @foreach ($rs['candidats'] as $cd)
                                                    <th class="align-middle">{{ $cd->lastname }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rs['desks'] as $dk)
                                                <tr>
                                                    <td><a href="javascript: void(0);"
                                                            class="text-body fw-bold">{{ $dk->label }} </a> </td>
                                                    @foreach ($rs['candidats'] as $cd)
                                                        <td class="align-middle fw-bold">
                                                            @php
                                                                $vote = $cd->vote->first();
                                                                dd($dk);
                                                            @endphp
                                                            @if ($vote != null && $vote->desk_id == $dk->id)
                                                                {{ ($vote->vote / $dk->vote) * 100 }}
                                                            @else
                                                                0
                                                            @endif
                                                            %
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
@endsection
