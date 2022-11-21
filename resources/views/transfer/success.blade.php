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

    <div id="logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" />
        </a>
    </div>
    <div class="login table-responsive">
        <div class="alert alert-success">
            {{ $result->message }}
        </div>
        <hr>
        <table class="table">
            <tr>
                <th>
                    reference
                </th>
                <th>
                    transfer_code
                </th>
                <th>
                    amount
                </th>
                <th>
                    currency
                </th>
                <th>
                    status
                </th>
            </tr>
            <tr>
                <td>
                    {{ $result->data->reference }}
                </td>
                <td>
                    {{ $result->data->transfer_code }}
                </td>
                <td>
                    {{ $result->data->amount / 100 }}
                </td>
                <td>
                    {{ $result->data->currency }}
                </td>
                <td>
                    {{ $result->data->status }}
                </td>
            </tr>
        </table>
        <a href="{{ route('index') }}" class="btn btn-secondary">Transfer again ?</a>
    </div>
</body>

</html>
