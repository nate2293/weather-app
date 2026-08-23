<x-layouts::app>

    {{-- Breadcrumbs --}}
    @php
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'icon' => 'm-home',
                'link' => route('dashboard'),
            ],
            [
                'label' => 'Weather',
                'icon' => 'm-cloud',
            ],
        ];
    @endphp

    <x-mary-breadcrumbs :items="$breadcrumbs" class="text-lg mb-4" />

    {{-- Search --}}
    <form method="GET" action="{{ route('weather.index') }}"  class="select-xl w-80 mb-4">

        <x-mary-input name="city" placeholder="Enter a city..." icon="o-map-pin" :value="request('city')">
            <x-slot:append>

                <x-mary-button type="submit" label="Search" icon="o-magnifying-glass"
                    class="select-xl btn btn-outline btn-primary" />

            </x-slot:append>
        </x-mary-input>

    </form>


    @if ($weather)
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

            <div class="flex flex-col gap-4 h-full">

                {{-- Current Weather --}}
                @if ($weather)
                    <x-mary-card title="Current Weather" subtitle="{{ $location['name'] }}" shadow
                        class="w-full border-2 border-dotted border-gray-400 rounded-xl">

                        {{-- Custom darker separator --}}
                        <div class="border-t border-gray-900 mb-4"></div>

                        {{-- Weather icon and temperature --}}
                        <div class="flex items-center">

                            <img src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png"
                                alt="{{ $weather['weather'][0]['description'] }}">

                            <x-mary-stat title="{{ ucfirst($weather['weather'][0]['description']) }}"
                                value="{{ round($weather['main']['temp']) }}°C" />

                        </div>

                        {{-- Feels like, humidity and wind --}}
                        <div class="grid grid-cols-3">

                            <x-mary-stat title="Feels Like" value="{{ round($weather['main']['feels_like']) }}°C" />

                            <x-mary-stat title="Humidity" value="{{ $weather['main']['humidity'] }}%" />

                            <x-mary-stat title="Wind" value="{{ $weather['wind']['speed'] }} m/s" />

                        </div>

                    </x-mary-card>
                @endif



                {{-- ============================================ --}}
                {{-- Forecast --}}
                {{-- ============================================ --}}

                <x-mary-card title="Forecast" subtitle="{{ $location['name'] }}" shadow
                    class="w-full border-2 border-dotted border-gray-400 rounded-xl">

                    <div class="border-t border-gray-900 mb-4"></div>

                    {{-- 5 Day and Hourly buttons --}}
                    <x-slot:menu>

                        <button class="btn btn-outline btn-primary">
                            5 Day
                        </button>

                    </x-slot:menu>


                    {{-- ============================================ --}}
                    {{-- 5 DAY FORECAST --}}
                    {{-- ============================================ --}}

                    @if ($forecastView === 'daily')

                        @foreach ($dailyForecast as $day)
                            <x-mary-list-item :item="$day">

                                {{-- Weather icon --}}
                                <x-slot:avatar>
                                    <img src="https://openweathermap.org/img/wn/{{ $day['weather'][0]['icon'] }}.png"
                                        alt="{{ $day['weather'][0]['description'] }}">
                                </x-slot:avatar>



                                {{-- High / Low temperature --}}
                                <x-slot:value>
                                    <x-mary-badge
                                        value="{{ round($day['main']['temp_max']) }}° / {{ round($day['main']['temp_min']) }}°" />
                                </x-slot:value>


                                {{-- Date --}}
                                <x-slot:actions>
                                    {{ date('jS M, D', strtotime($day['dt_txt'])) }}
                                </x-slot:actions>

                            </x-mary-list-item>
                        @endforeach


                        {{-- ============================================ --}}
                        {{-- HOURLY FORECAST --}}
                        {{-- ============================================ --}}
                    @else
                        @foreach (array_slice($forecast['list'], 0, 5) as $hour)
                            <x-mary-list-item :item="$hour">

                                {{-- Weather icon --}}
                                <x-slot:avatar>
                                    <img src="https://openweathermap.org/img/wn/{{ $hour['weather'][0]['icon'] }}.png"
                                        alt="{{ $hour['weather'][0]['description'] }}">
                                </x-slot:avatar>


                                {{-- Time --}}
                                <x-slot:value>
                                    {{ date('g:i A', strtotime($hour['dt_txt'])) }}
                                </x-slot:value>


                                {{-- Weather description --}}
                                <x-slot:sub-value>
                                    {{ ucfirst($hour['weather'][0]['description']) }}
                                </x-slot:sub-value>

                                {{-- Temperature --}}
                                <x-slot:actions>
                                    <x-mary-badge value="{{ round($hour['main']['temp']) }}°C" />
                                </x-slot:actions>

                            </x-mary-list-item>
                        @endforeach

                    @endif

                </x-mary-card>

                <x-mary-card title="Today's Details" shadow
                    class="w-full flex-1 border-2 border-dotted border-gray-400 rounded-xl">

                    <div class="border-t border-gray-900 mb-4"></div>

                    {{-- Low Temperature --}}
                    <x-mary-list-item :item="$weather">
                        <x-slot:avatar>
                            <x-mary-icon name="o-arrow-down" class="w-6 h-6" />
                        </x-slot:avatar>

                        <x-slot:value>
                            Low Temperature
                        </x-slot:value>

                        <x-slot:actions>
                            {{ round($weather['main']['temp_min']) }}°C
                        </x-slot:actions>
                    </x-mary-list-item>


                    {{-- High Temperature --}}
                    <x-mary-list-item :item="$weather">
                        <x-slot:avatar>
                            <x-mary-icon name="o-arrow-up" class="w-6 h-6" />
                        </x-slot:avatar>

                        <x-slot:value>
                            High Temperature
                        </x-slot:value>

                        <x-slot:actions>
                            {{ round($weather['main']['temp_max']) }}°C
                        </x-slot:actions>
                    </x-mary-list-item>


                    {{-- Sunrise --}}
                    <x-mary-list-item :item="$weather">
                        <x-slot:avatar>
                            <x-mary-icon name="o-sun" class="w-6 h-6" />
                        </x-slot:avatar>

                        <x-slot:value>
                            Sunrise
                        </x-slot:value>

                        <x-slot:actions>
                            {{ date('g:i A', $weather['sys']['sunrise']) }}
                        </x-slot:actions>
                    </x-mary-list-item>


                    {{-- Sunset --}}
                    <x-mary-list-item :item="$weather">
                        <x-slot:avatar>
                            <x-mary-icon name="o-moon" class="w-6 h-6" />
                        </x-slot:avatar>

                        <x-slot:value>
                            Sunset
                        </x-slot:value>

                        <x-slot:actions>
                            {{ date('g:i A', $weather['sys']['sunset']) }}
                        </x-slot:actions>
                    </x-mary-list-item>

                </x-mary-card>

            </div>


            {{-- CHANGED: LARGE MAP AREA --}}

            @if ($location)
                <div class="lg:col-span-2 flex flex-col gap-4 h-full">

                    <x-mary-card title="Map" subtitle="{{ $location['name'] }}" shadow
                        class="w-full border-2 border-dotted border-gray-400 rounded-xl">

                        <div class="border-t border-gray-900 mb-4"></div>

                        <div id="weather-map" class="h-[500px] w-full rounded-lg" data-lat="{{ $location['lat'] }}"
                            data-lon="{{ $location['lon'] }}" data-location="{{ $location['name'] }}"></div>

                    </x-mary-card>

                    {{-- ============================================ --}}
                    {{-- ADDED: 24 HOUR TEMPERATURE CHART --}}
                    {{-- ============================================ --}}

                    <x-mary-card title="Temperature" subtitle="Next 24 Hours" shadow
                        class="w-full flex-1 border-2 border-dotted border-gray-400 rounded-xl">

                        <div class="border-t border-gray-900 mb-4"></div>


                        <div id="temperature-chart" class="w-full h-72" data-forecast='@json(array_slice($forecast['list'], 0, 8))'>
                        </div>

                    </x-mary-card>

                </div>
            @endif

        </div>

    @endif


</x-layouts::app>
