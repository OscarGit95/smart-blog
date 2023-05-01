<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="form">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h2 class="form__title">Restaurar contraseña</h2>

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
            <div class="form__group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form__input" value="{{old('password_confirmation')}}" autocomplete="current-password" placeholder=" " required>
                <label for="password_confirmation" class="form__label">Confirma tu contraseña</label>
                <span class="form__span_error">
                    @foreach ($errors->get('password_confirmation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        
        <div class="form__container">
            <input type="submit" class="form__submit" value="Restaurar contraseña">
        </div>
        
    </form>
</x-guest-layout>
