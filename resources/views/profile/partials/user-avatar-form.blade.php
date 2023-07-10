<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Avatar') }}
        </h2>
    </header>

    @if (session('message'))
        <div class="mt-2">
            <p style="color: red">{{ session('message') }}</p>
        </div>
    @endif
    <img width="100" height="100" class="rounded mt-2" src="{{ "/storage/$user->avatar" }}" alt="user-avatar">
    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Add or update user avatar.') }}
    </p>

    <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" class="mt-2" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" required autofocus
                autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
