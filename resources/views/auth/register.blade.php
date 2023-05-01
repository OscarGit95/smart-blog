<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf
        <h2 class="form__title">Registro de usuario</h2>
        <div class="form__container">
            <div class="form__group">
                <input type="text" id="name" name="name" class="form__input" value="{{old('name')}}" placeholder=" " required>
                <label for="name" class="form__label">Nombre</label>
                <span class="form__span_error"> 
                    @foreach ($errors->get('name') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        <div class="form__container">
            <div class="form__group">
                <input type="text" id="last_name" name="last_name" class="form__input" value="{{old('last_name')}}" placeholder=" " required>
                <label for="last_name" class="form__label">Apellido</label>
                <span class="form__span_error"> 
                    @foreach ($errors->get('last_name') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        <div class="form__container">
            <div class="form__group">
                <input type="number" id="age" name="age" class="form__input" value="{{old('age')}}" placeholder=" " required>
                <label for="age" class="form__label">Edad</label>
                <span class="form__span_error"> 
                    @foreach ($errors->get('age') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        <div class="form__container">
            <div class="form__group">
                <input type="text" id="username" name="username" class="form__input" value="{{old('username')}}" placeholder=" " required>
                <label for="username" class="form__label">Nombre de usuario</label>
                <span class="form__span_error"> 
                    @foreach ($errors->get('username') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
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
                <input type="password" id="password_confirmation" name="password_confirmation" class="form__input"  autocomplete="current-password" placeholder=" " required>
                <label for="password_confirmation" class="form__label">Confirma tu contraseña</label>
                <span class="form__span_error">
                    @foreach ($errors->get('password_confirmation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </span>
            </div>
        </div>
        <div class="form__container">
            <input type="submit" class="form__submit" value="Regístrate">
        </div>
    </form>
</x-guest-layout>
