<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Eng.Soliman Adel">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" charset="utf-8">
    <title>Paystack - Enter OTP</title>
</head>
<body>

    <div id="logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" />
        </a>
    </div>

    <div class="login">
        <b>OTP CONFIRMATION</b>
        <hr>
        <div class="row">
            @if( !empty($message) )
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif
            <form action="{{route('finalizeTransfer')}}" method="post">
                @csrf
                <input type="hidden" name="transfer_code" value="{{$transfer_code}}">
                <div class="mt-3">
                    <input type="text" class="form-control" placeholder="Enter OTP" name="otp" required>
                </div>
                <div class="mt-3 d-grid gap-2">
                    <input type="submit" class="btn btn-secondary" style="background:#39AC37;" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
