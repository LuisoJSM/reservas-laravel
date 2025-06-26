<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Mis reservas') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white dark:bg-gray-900 sm:rounded-lg m-4 mt-6">
        @if ($bookings->isEmpty())
            <div
                class="p-6 bg-red-100 dark:bg-red-700 text-red-800 dark:text-white rounded-md text-center text-lg font-medium">
                No tienes reservas activas.
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($bookings as $booking)
                    @php
                        $slot = $booking->slot;
                        $business = $slot->business;
                        $isPast = $slot->slot_date->isPast();
                    @endphp

                    <div
                        class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-xl px-5 py-4 space-y-2">
                        {{-- Encabezado + Etiqueta --}}
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold">{{ $business->name }}</h3>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
    {{ $isPast
        ? 'bg-red-500 text-white'
        : 'bg-green-100 text-green-800 dark:bg-green-600 dark:text-white' }}">
    {{ $isPast ? 'Pasada' : 'Activa' }}
</span>

                        </div>

                        {{-- Datos --}}
                        <p class="text-sm">{{ $business->address }}</p>
                        <p class="text-sm">{{ $business->phone }}</p>

                        <hr class="border-gray-300 dark:border-gray-600 my-2">

                        <p class="text-sm flex items-center gap-2">
                            <i class="far fa-clock text-gray-500 dark:text-gray-300"></i>
                            {{ $slot->start_time }} - {{ $slot->end_time }}
                        </p>

                        <p class="text-sm flex items-center gap-2">
                            <i class="far fa-calendar-alt text-purple-500 dark:text-purple-300"></i>
                            {{ $slot->slot_date->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
