<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf
        @if(session('status'))
            <p class="form__paragraph">Se ha enviado un link de recuperación al correo proporcionado</p>
        @endif
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
