@extends('layouts.login')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Enregistrement</h5>
                                <p>Créer votre compte rapidement.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="admin/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <a href="{{ route('home') }}">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="admin/images/logo.svg" alt="" class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="Prénom" value="{{ old('firstname') }}">

                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    value="{{ old('lastname') }}" placeholder="Nom" required>
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="useremail" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="phonenumber" name="phone"
                                    value="{{ old('phone') }}" placeholder="Téléphone">
                            </div>

                            <div class="mb-3">
                                <label for="userpassword" class="form-label">Mot de Passe</label>
                                <input type="password" class="form-control" id="userpassword" name="password"
                                    value="{{ old('password') }}" placeholder="Mot de passe" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="userpassword" class="form-label">Mot de Passe</label>
                                <input type="password" class="form-control" id="userpassword" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" placeholder="Confirmer Mot de passe"
                                    required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-check" required>
                                <label class="form-check-label" for="terms-check">
                                    J'accepte
                                    les <a href="#" class="text-primary">Termes d'utilisation</a>
                                </label>
                            </div>

                            <div class="mt-4 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Valider</button>
                            </div>

                            <div class="mt-4 text-center">
                                <h5 class="font-size-14 mb-3">S'inscrire avec</h5>

                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ url('/auth/facebook') }}"
                                            class="social-list-item bg-primary text-white border-primary">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="{{ url('/auth/twitter') }}"
                                            class="social-list-item bg-info text-white border-info">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="{{ url('/auth/google') }}"
                                            class="social-list-item bg-danger text-white border-danger">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">

                <div>
                    <p>Vous avez un compte ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Connexion</a>
                    </p>
                    <p>©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Ova. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                        Codeur X
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script language="JavaScript">
        const phoneInputField = document.querySelector("#phonenumber");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["ga", "fr", "cm", "us"],
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",

        });
    </script>
@endpush
