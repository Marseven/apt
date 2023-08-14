@extends('layouts.default')

@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-7 p-sm-0">
                <div class="ufg-job-application-wrapper pt150">
                    <form action="{{ route('register') }}" method="POST" class="job-application-form">
                        @csrf

                        <h3>Informations du Partisan</h3>

                        <div class="form-group">
                            <input type="text" name="lastname" class="form-control" id="input-lastname" required>
                            <label for="input-lastname">Nom</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="firstname" class="form-control" id="input-firstname" required>
                            <label for="input-firstname">Prénom</label>
                        </div>

                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" id="input-phone" required>
                            <label for="input-phone">Téléphone</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="hood" class="form-control" id="input-hood" required>
                            <label for="input-hood">Quartier</label>
                        </div>

                        <button type="submit" class="btn">Enregistrer</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
