<x-guest-layout>
    @section('title', 'Login')

    <h4 class="fw-bold text-center mb-4">Login to your account</h4>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-success small">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success">Login</button>
        </div>

        <p class="text-center text-muted small mb-0">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-success fw-semibold">Register here</a>
        </p>

    </form>
</x-guest-layout>