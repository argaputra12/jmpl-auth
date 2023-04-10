<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Google Captcha -->
    <input type="hidden" name="recaptcha_v3" id="recaptcha_v3">

    <!-- Name -->
    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
        autofocus autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
        required autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
        href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ml-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>

    <div class="mt-6 mb-3 flex justify-center">
        <a href="{{ route('login.google') }}" class="py-2 px-4 bg-slate-200 hover:bg-white duration-300 transition-all text-center rounded-md w-full">
          Sign In Using Google Account
        </a>
    </div>
  </form>

  <!-- Google Captcha -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LfQ8mIlAAAAAMjrR_-Q8-uk2PhAe_5O2JQxBSKJ"></script>

  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute("6LfQ8mIlAAAAAMjrR_-Q8-uk2PhAe_5O2JQxBSKJ", {
        action: 'homepage'
      }).then(function(token) {
        if (token) {
          //js
          document.getElementById('recaptcha_v3').value = token;
          //if you use jquery library
          //$("#recaptcha_v3").val(token);
        }
      });
    });
  </script>
</x-guest-layout>
