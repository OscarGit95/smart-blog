<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    {{-- <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form> --}}
    <form method="POST" action="{{ route('password.confirm') }}" class="form">
        @csrf
        <h2 class="form__title">Confirmación de contraseña</h2>
        <p class="form__paragraph">Esta es un área segura de la aplicación. Confirma tu contraseña antes de continuar.</p>

        <div class="form__container">
            <div class="form__group">
                <input type="password" id="password" name="password" class="form__input" value="{{old('password')}}" autocomplete="current-password" placeholder=" " required>
                <label for="password" class="form__label">Contraseña</label>
                <span class="form__span_error">
                    @foreach ($errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        
        <div class="form__container">
            <input type="submit" class="form__submit" value="Ingresar">
        </div>
    </form>
</x-guest-layout>
