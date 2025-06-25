<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Negocios') }}
        </h2>
    </x-slot>

    <div class="p-4 bg-white dark:bg-gray-900 shadow sm:rounded-lg m-4 mt-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($businesses as $business)
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $business->image }}" alt="{{ $business->name }}"
                        class="w-full h-32 object-cover rounded-t-xl">

                    <div class="p-4 text-gray-800 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-1">{{ $business->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">{{ $business->address }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $business->phone }}</p>

                        <ul class="mt-4 space-y-2">
                            @foreach ($business->schedules as $schedule)
                                <li>
                                    <span class="font-semibold">
                                        {{ $schedule->day_of_week_string }}:
                                    </span>

                                    @if (! $schedule->is_closed)
                                        {{ $schedule->open_time }} - {{ $schedule->close_time }}
                                    @else
                                        Cerrado
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-4 border-t border-gray-200 dark:border-gray-600 pt-4">
                            <a href="{{ route('slots.show', [
                                'business' => $business,
                                'year' => now()->year,
                                'month' => now()->month,
                                'day' => now()->day
                            ]) }}"
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                Ver disponibilidad
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
