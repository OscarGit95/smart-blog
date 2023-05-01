<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf
        <h2 class="form__title">Iniciar sesión</h2>
        <p class="form__paragraph">¿Aún no tienes una cuenta? <a href="{{ route('register') }}" class="form__link">Regístrate</a></p>

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
        <p class="form__paragraph">¿Olvidaste tu contraseña? <a href="{{ route('password.request') }}" class="form__link">Recupérala</a></p>
    </form>
</x-guest-layout>
