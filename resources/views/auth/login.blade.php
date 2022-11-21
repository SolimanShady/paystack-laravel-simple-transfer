<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eng.Soliman Adel">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" charset="utf-8">
    <title>Paystack - login</title>
</head>
<body>

    <div id="logo">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" />
    </div>

    <div class="login">

        @if( session()->has('message') )
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="post" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" class="form-control" name="email" required="required" placeholder="Enter email">
                @error('email')
                    <b id="error-text">{{ $message }}</b>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" class="form-control" name="password" required="required" placeholder="Enter password">
                @error('password')
                    <b id="error-text">{{ $message }}</b>
                @enderror
            </div>

            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
