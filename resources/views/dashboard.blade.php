<x-app-layout>
    <x-slot name="header">
        <p class="header_secondary__username">Bienvenido {{ Auth::user()->email }}</p>
        <h1 class="header_secondary__title">Inicio</h1>
    </x-slot>

    <div>
        <h1 style="color:white">Hola</h1>
    </div>
</x-app-layout>
