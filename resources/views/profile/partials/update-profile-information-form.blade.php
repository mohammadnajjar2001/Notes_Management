

<section class="profile-container">
    <header class="profile-header">
        <h2>{{ __('Profile Information') }}</h2>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="input-group">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        </div>

        <div class="input-group">
            <label for="email">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="verification-message">
                <p>{{ __('Your email address is unverified.') }}</p>
                <button form="send-verification" class="save-button">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </div>
        @endif

        <button type="submit" class="save-button">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
            <p class="success-message">{{ __('Saved.') }}</p>
        @endif
    </form>
</section>
