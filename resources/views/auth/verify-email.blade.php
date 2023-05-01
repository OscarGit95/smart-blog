<x-guest-layout>
    <div class="form">
        <p class="form__paragraph">¡Gracias por registrarte! Antes de comenzar, verifica tu correo electrónico haciendo click al enlace que te acabamos de enviar.</p>
        <p class="form__paragraph">Si no recibiste el correo electrónico con gusto te enviaremos otro.</p>
        @if (session('status') == 'verification-link-sent')
            <div class="form__container">
                <span class="form__span_error"> 
                    Un nuevo enlace ha sido enviado a tu correo electrónico
                </span>
            </div>
        @endif
    </div>
    <form method="POST" action="{{ route('verification.send') }}" class="form">
        @csrf
        <div class="form__container">
            <input type="submit" class="form__submit" value="Reenviar enlace de verificación">
        </div>
    </form>
    <form method="POST" action="{{ route('verification.send') }}" class="form">
        @csrf
        <div action="{{ route('logout') }}">
            <input type="submit" class="form__submit" value="Salir">
        </div>
    </form>
</x-guest-layout>
