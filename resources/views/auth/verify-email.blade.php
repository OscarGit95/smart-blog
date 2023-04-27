<x-guest-layout>
    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div> --}}
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
