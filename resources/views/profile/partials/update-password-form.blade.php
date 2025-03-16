<section class="profile-container">
    <header class="profile-header">
        <h2>{{ __('Update Password') }}</h2>
        <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="input-group">
            <label for="update_password_current_password">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
            <span class="error-message">
                @error('current_password') {{ $message }} @enderror
            </span>
        </div>

        <div class="input-group">
            <label for="update_password_password">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password">
            <span class="error-message">
                @error('password') {{ $message }} @enderror
            </span>
        </div>

        <div class="input-group">
            <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
            <span class="error-message">
                @error('password_confirmation') {{ $message }} @enderror
            </span>
        </div>

        <button type="submit" class="save-button">{{ __('Save') }}</button>

        @if (session('status') === 'password-updated')
            <p class="success-message">{{ __('Password Updated Successfully.') }}</p>
        @endif
    </form>
</section>
