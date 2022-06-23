<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-3" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Email address</label>
                    <input type="password" name="password" class="form-control" id="password" required autocomplete="current-password" >
                </div>

                <!-- Remember Me -->
                <div class="mb-3">
                    <div class="form-check">
                        <x-checkbox id="remember_me" name="remember" />

                        <label class="form-check-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <button type="submit" class="btn btn-dark">Log in</button>
                    </div>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
