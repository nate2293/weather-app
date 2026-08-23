<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'city' => 'nullable|string|max:255',
        ]);

        $city = $request->input('city', 'Derry');

        $forecastView = $request->input('view', 'daily');

        $locationResponse = Http::get('https://api.openweathermap.org/geo/1.0/direct', [
            'q' => $city,
            'limit' => 5,
            'appid' => config('services.openweather.key'),
        ]);

        $locations = $locationResponse->json();

        $location = $locations[0] ?? null;

        $weatherData = null;

        $forecastData = null;
        $dailyForecast = [];

        if ($location) {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => $location['lat'],
                'lon' => $location['lon'],
                'appid' => config('services.openweather.key'),
                'units' => 'metric',
            ]);
            if ($response->failed()) {
                return redirect()->back()->withErrors([
                    'city' => 'Unable to fetch weather data. Please try again later.',
                ]);
            }

            $weatherData = $response->json();

            $forecastResponse = Http::get(
                'https://api.openweathermap.org/data/2.5/forecast',
                [
                    'lat' => $location['lat'],
                    'lon' => $location['lon'],
                    'appid' => config('services.openweather.key'),
                    'units' => 'metric',
                ]
            );

            $forecastData = $forecastResponse->json();

            $dailyForecast = [];

            foreach ($forecastData['list'] as $forecast) {

                if (str_contains($forecast['dt_txt'], '12:00:00')) {
                    $dailyForecast[] = $forecast;
                }
            }
        }

        return view('weather.index', [
            'weather' => $weatherData,
            'location' => $location,
            'forecast' => $forecastData,
            'dailyForecast' => $dailyForecast,
            'forecastView' => $forecastView,
        ]);
    }
}
