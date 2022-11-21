@include("admin.header")

<div class="page">
    <h4>Settings</h4>
    <hr>
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <form action="{{ route('settings.update') }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="secret_key" class="form-label">Secret Key</label>
                <input type="text" id="secret_key" class="form-control" name="secret_key" value="{{ $settings->secret_key }}">
                @error('secret_key')
                    <b id="error-text">{{ $message }}</b>
                @enderror
            </div>

            <div class="mb-3">
                <label for="public_key" class="form-label">Public Key</label>
                <input type="text" id="public_key" class="form-control" name="public_key" value="{{ $settings->public_key }}">
                @error('public_key')
                    <b id="error-text">{{ $message }}</b>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update settings</button>
        </form>
    </div>
</div>

@include("admin.footer")
