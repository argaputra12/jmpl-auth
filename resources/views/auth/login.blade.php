<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Google Captcha -->
    <input type="hidden" name="recaptcha_v3" id="recaptcha_v3">

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
      <x-input-error :messages="$errors->get('recaptcha_v3')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
      <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox"
          class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
          name="remember">
        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
      </label>
    </div>

    <div class="flex items-center justify-end mb-4">

      @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
          href="{{ route('password.request') }}">
          {{ __('Forgot your password?') }}
        </a>
      @endif

      <x-primary-button class="ml-3">
        {{ __('Log in') }}
      </x-primary-button>

    </div>

    <div class="mt-6 mb-3 flex justify-center">
      <a href="{{ route('login.google') }}"
        class="py-2 px-4 bg-slate-200 hover:bg-white duration-300 transition-all text-center rounded-md w-full">
        Sign In Using Google Account
      </a>
    </div>

  </form>

  <!-- Google Captcha -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LcNs3MlAAAAABs9YxsvEJ6_wD-BCJ-XsLMlmVrn"></script>

  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute("6LcNs3MlAAAAABs9YxsvEJ6_wD-BCJ-XsLMlmVrn", {
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
