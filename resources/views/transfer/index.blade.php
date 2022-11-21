<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Eng.Soliman Adel">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" charset="utf-8">
    <title>Paystack - Transfer Page</title>
</head>
<body>

    <div id="logo" class="mb-3">
        <a href="{{ route('index') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" />
        </a>
    </div>
    <div class="login">
        <b>Recipient account verification</b>
        <hr>
        <div class="row">

            @if( session()->has('message') )
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
            @endif

            <form action="{{route('verify-account')}}" method="POST">
                @csrf
                <div class="mb-3 mt-3">
                    <input type="number" name="account_number" id="account_number" class="form-control" placeholder="Enter Account Number" required>
                </div>
                <div class="mb-3 mt-3">
                    <input type="number" name="bank_code" id="bank_code" class="form-control" placeholder="Enter Bank Code" required>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" value="Verfy Account" style="background:#39AC37;" class="btn btn-secondary">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
