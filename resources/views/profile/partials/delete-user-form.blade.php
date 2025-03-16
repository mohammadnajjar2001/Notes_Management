<section class="profile-container">
    <header class="profile-header">
        <h2>{{ __('Delete Account') }}</h2>
        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="delete-button" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </button>

    <div x-data="{ open: false }" x-show="open" class="modal">
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('delete')

            <h2>{{ __('Are you sure you want to delete your account?') }}</h2>
            <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="input-group">
                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required>
                <span class="error-message">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="button-group">
                <button type="button" class="cancel-button" x-on:click="open = false">{{ __('Cancel') }}</button>
                <button type="submit" class="confirm-delete-button">{{ __('Delete Account') }}</button>
            </div>
        </form>
    </div>
</section>
