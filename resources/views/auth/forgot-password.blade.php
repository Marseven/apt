@extends('layouts.login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Mot de passe Oublié !</h5>
                                <p>Saisissez votre email pour continuer.</p>
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
                                    <img src="admin/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>

                        <a href="{{ route('home') }}" class="auth-logo-dark">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="admin/images/logo.svg" alt="" class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="username"
                                    value="{{ old('email') }}" autocomplete="off" placeholder=" Email">
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">

                <div>
                    <p>Vous avez trouvé ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Conectez-vous
                        </a>
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
