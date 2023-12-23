<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            Update Password
        </h2>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <div class="form-group">
                <label for="password" class="control-label">Current Password</label>
                <input id="current_password" type="password" class="form-control" name="current_password" tabindex="2" required autocomplete="current-password">
            </div>
            @error('current_password')
                <div class="text-danger mb-4" >
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <div class="form-group">
                <label for="password" class="control-label">New Password</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="new-password">
            </div>
            @error('password')
                <div class="text-danger mb-4" >
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <div class="form-group">
                <label for="password" class="control-label">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="2" required autocomplete="new-password">
            </div>
            @error('password_confirmation')
                <div class="text-danger mb-4" >
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary float-right">Save</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
