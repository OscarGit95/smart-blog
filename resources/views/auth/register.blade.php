<x-guest-layout>
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
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
