@extends('layouts.login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Réinitialiser le Mot de passe !</h5>
                                <p>Saisissez le nouveau mot de passe.</p>
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
                        <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="username"
                                    value="{{ old('email') }}" autocomplete="off" placeholder=" Email">
                                <input value="{{ $token }}" type="hidden" name="token" />
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

                            <div class="mb-3">
                                <label class="form-label">Confirmer Mot de passe</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Mot de Passe" value="{{ old('password_confirmation') }}"
                                        autocomplete="off" aria-label="Password" aria-describedby="password-addon">
                                    <button class="btn btn-light " type="button" id="password-addon"><i
                                            class="mdi mdi-eye-outline"></i></button>

                                </div>
                                @error('password_confirmation')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Valider</button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">

                <div>
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
