<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Eng.Soliman Adel">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" charset="utf-8">
    <title>Paystack - Initiate Transfer</title>
</head>
<body>

    <div id="logo" style="top:10%;">
        <a href="{{ route('index') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" />
        </a>
    </div>

    <div class="login">
        <b>Transfer Process</b>
        <hr>
        <div class="row">
            @if( session()->has('message') )
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action="{{route('transfer')}}" method="post">
                @csrf
                <input type="hidden" name="recipient_code" value="{{$recipient_code}}" >
                <div class="mt-3">
                    <input type="text" name="account_name" id="account_name", class="form-control" value="{{$account_name}}" disabled>
                </div>
                <div class="mt-3">
                    <input type="number" name="account_number" id="account_number", class="form-control" value="{{$account_number}}" disabled>
                </div>
                <div class="mt-3">
                    <input type="text" name="bank_name" id="bank_name", class="form-control" value="{{$bank_name}}" disabled>
                </div>
                <div class="mt-3">
                    <input type="number" name="amount" id="amount" min="10" class="form-control" placeholder="Enter Amount to Transfer" required>
                    @error('amount')
                        <b id="error-text">{{ $message }}</b>
                    @enderror
                </div>
                <div class="mt-3">
                    <input type="text" name="reason" id="reason" class="form-control" placeholder="Reason for transfer">
                    @error('reason')
                        <b id="error-text">{{ $message }}</b>
                    @enderror
                </div>
                <div class="mt-3 d-grid gap-2">
                    <input type="submit" value="Transfer" style="background:#39AC37;" class="btn btn-secondary ">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
