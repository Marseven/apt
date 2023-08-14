@if ($message = Session::get('success'))
    <div class="alert alert-success " role="alert">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger " role="alert">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning " role="alert">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info " role="alert">
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger " role="alert">
        @foreach ($errors->all() as $error)
            <div class="alert-text">{{ $error }}</div>
        @endforeach
    </div>
@endif
