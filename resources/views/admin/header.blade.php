<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eng.Soliman Adel">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" charset="utf-8">
    <title>Paystack - Dashboard</title>
</head>
<body>
<header class="d-flex">
    <a href="{{ route('admin.index') }}">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" />
    </a>
    <div class="flex-fill">
        <ul>
            <li>
                <a href="{{ route('admin.index') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('transactions') }}">Transactions</a>
            </li>
            <li>
                <a href="{{ route('settings') }}">Settings</a>
            </li>
            <li>
                <a href="{{ route('account') }}">Account</a>
            </li>
            <li>
                <a href="{{ route('auth.logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</header>
