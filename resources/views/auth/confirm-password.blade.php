<x-guest-layout>
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
