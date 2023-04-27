<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
{{-- 
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}

    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf
        <h2 class="form__title">Recuperación de contraseña</h2>
        <p class="form__paragraph">¿Olvidaste tu contraseña? No te preocupes, escribe tu correo electrónico y te enviaremos un link para cambiarla por una nueva.</p>
        <div class="form__container">
            <div class="form__group">
                <input type="text" id="email" name="email" class="form__input" value="{{old('email')}}" placeholder=" " required>
                <label for="email" class="form__label">Correo electrónico</label>
                <span class="form__span_error"> 
                    @foreach ($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        
        <div class="form__container">
            <input type="submit" class="form__submit" value="Enviar link de recuperación">
        </div>
    </form>
</x-guest-layout>
