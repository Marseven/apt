@php
    $lang = App::getLocale();
@endphp
<!DOCTYPE html>
<html lang="{{ $lang }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Akanda Pour Tous</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">

    <!-- External Css -->
    <link rel="stylesheet" href="{{ asset('front/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/job-1.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('front/images/ico_apt.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('front/images/ico_apt.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('front/images/ico_apt.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('front/images/ico_apt.png') }}">


    <link rel="stylesheet" href="{{ asset('front/css/notification.css') }}" />

</head>

<body>
    <div class="ugf-wrapper">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('front/images/logo.png') }}" class="img-fluid logo-white" alt="logo">
                <img src="{{ asset('front/images/logo-dark.png') }}" class="img-fluid logo-black" alt="logo">
            </a>
        </div>
        <div class="ugf-content-block">
            <div class="content-block">
                <h1>Akanda Pour Tous</h1>
                <p>Pour une commune dynamique et prospère.</p>
            </div>
        </div>

        @yield('content')

        <div class="footer">
            <div class="social-links">
                <a href="#"><i class="lab la-facebook-f"></i></a>
                <a href="#"><i class="lab la-twitter"></i></a>
                <a href="#"><i class="lab la-instagram"></i></a>
            </div>
            <div class="copyright">
                <p>Copyright © {{ date('Y') }} Akanda Pour Tous. Tous Droits Réservés</p>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('front/js/custom.js') }}"></script>

    <script src="{{ asset('front/js/notification.js') }}"></script>

    <script>
        @if ($message = Session::get('success'))
            const notification3 = new Notification({
                text: '{{ $message }}',
                showProgress: false,
                style: {
                    background: '#28a745',
                    color: '#ffffff',
                    transition: 'all 350ms linear',
                },
            });
        @endif

        @if ($message = Session::get('error'))
            const notification3 = new Notification({
                text: '{{ $message }}',
                showProgress: false,
                style: {
                    background: '#dc3545',
                    color: '#ffffff',
                    transition: 'all 350ms linear',
                },
            });
        @endif

        @if ($message = Session::get('warning'))
            const notification3 = new Notification({
                text: '{{ $message }}',
                showProgress: false,
                style: {
                    background: '#ffc107',
                    color: '#ffffff',
                    transition: 'all 350ms linear',
                },
            });
        @endif

        @if ($message = Session::get('info'))
            const notification3 = new Notification({
                text: '{{ $message }}',
                showProgress: false,
                style: {
                    background: '#17a2b8',
                    color: '#ffffff',
                    transition: 'all 350ms linear',
                },
            });
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                const notification3 = new Notification({
                    text: "{{ $error }}",
                    showProgress: false,
                    style: {
                        background: '#dc3545',
                        color: '#ffffff',
                        transition: 'all 350ms linear',
                    },
                });
            @endforeach
        @endif
    </script>
</body>

</html>
