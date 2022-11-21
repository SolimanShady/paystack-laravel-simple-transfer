@include("admin.header")

<div class="page">

    <h4>Account Details</h4>
    <hr>
    <div class="container">

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

        <form action="{{ route('account.update') }}" method="post">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="text" id="email" class="form-control" name="email" value="{{ $data->email }}">
                @error('email')
                    <b id="error-text">{{ $message }}</b>
                @enderror
            </div>

            <div class="mb-3">

                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="password">
                <input type="hidden" name="password_hidden" value="{{ session()->get('password') }}">

                @error('password')
                    <b id="error-text">{{ $message }}</b>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __("update account") }}</button>
        </form>
    </div>
</div>

@include("admin.footer")
