@extends('layouts.login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Bienvenu !</h5>
                                <p>Connectez-vous pour continuer.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="admin/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="auth-logo">
                        <a href="{{ route('home') }}" class="auth-logo-light">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('front/images/logo-dark.png') }}" alt=""
                                        class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>

                        <a href="{{ route('home') }}" class="auth-logo-dark">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('front/images/logo-dark.png') }}" alt=""
                                        class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="username"
                                    value="{{ old('email') }}" autocomplete="off" placeholder=" Email ou Téléphone ">
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mot de passe</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" name="password" placeholder="Mot de Passe"
                                        value="{{ old('password') }}" autocomplete="off" aria-label="Password"
                                        aria-describedby="password-addon">
                                    <button class="btn btn-light " type="button" id="password-addon"><i
                                            class="mdi mdi-eye-outline"></i></button>

                                </div>
                                @error('password')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-check">
                                <label class="form-check-label" for="remember-check">
                                    Rester Connecter
                                </label>
                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Connexion</button>
                            </div>



                            <div class="mt-4 text-center">
                                <a href="{{ route('password.request') }}" class="text-muted"><i
                                        class="mdi mdi-lock me-1"></i>
                                    Mot de passe oublié ?</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">

                <div>
                    {{-- <p>Pas de compte ? <a href="{{ route('register') }}" class="fw-medium text-primary"> Inscrivez-vous
                        </a>
                    </p> --}}
                    <p>©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Akanda Pour Tous. Tous Droits Réservé
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
