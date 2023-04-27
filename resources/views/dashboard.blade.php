<x-app-layout>
    <x-slot name="header">
        <p class="header_secondary__username">¡Bienvenid@ {{ Auth::user()->userInformation->username }}!</p>
        <h1 class="header_secondary__title">Inicio</h1>
    </x-slot>

    <div>
        <h1 style="color:white">Hola aqui el inicio</h1>
    </div>
</x-app-layout>
