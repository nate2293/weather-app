import L from "leaflet";
import "leaflet/dist/leaflet.css";
import ApexCharts from "apexcharts";

document.addEventListener("DOMContentLoaded", function () {
    const mapElement = document.getElementById("weather-map");

    if (!mapElement) {
        return;
    }

    // Location data passed from Laravel Blade
    const latitude = Number(mapElement.dataset.lat);
    const longitude = Number(mapElement.dataset.lon);
    const location = mapElement.dataset.location;

    // OpenWeather API key from .env
    const openWeatherKey = import.meta.env.VITE_OPENWEATHER_KEY;

    // ==========================================
    // CREATE MAP
    // ==========================================

    const map = L.map("weather-map").setView([latitude, longitude], 7);

    // ==========================================
    // BASE MAP
    // ==========================================

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap",
    }).addTo(map);

    // ==========================================
    // OPENWEATHER TEMPERATURE LAYER
    // ==========================================

    // ==========================================
// OPENWEATHER CLOUD LAYER
// ==========================================

const cloudLayer = L.tileLayer(
    `https://tile.openweathermap.org/map/clouds_new/{z}/{x}/{y}.png?appid=${openWeatherKey}`,
    {
        attribution: "&copy; OpenWeatherMap",
        opacity: 1,
    },
);

cloudLayer.addTo(map);

    // ==========================================
    // LOCATION MARKER
    // ==========================================

    L.marker([latitude, longitude]).addTo(map).bindPopup(location).openPopup();
});

// ==========================================
// 24 HOUR TEMPERATURE CHART
// ==========================================

document.addEventListener("DOMContentLoaded", function () {
    const chartElement = document.getElementById("temperature-chart");

    if (!chartElement) {
        return;
    }

    const forecast = JSON.parse(chartElement.dataset.forecast);

    const times = forecast.map(function (item) {
        const date = new Date(item.dt_txt);

        return date.toLocaleTimeString([], {
            hour: "numeric",
            hour12: true,
        });
    });

    const temperatures = forecast.map(function (item) {
        return Math.round(item.main.temp);
    });

    // ==========================================
    // APEXCHARTS OPTIONS
    // ==========================================

    const options = {
        series: [
            {
                name: "Temperature",
                data: temperatures,
            },
        ],

        chart: {
            type: "area",
            height: 280,
            toolbar: {
                show: false,
            },
        },

        xaxis: {
            categories: times,
        },

        yaxis: {
            labels: {
                formatter: function (value) {
                    return Math.round(value) + "°C";
                },
            },
        },

        grid: {
            strokeDashArray: 4,
        },

        stroke: {
            curve: "straight",
        },

        fill: {
            type: "gradient",
            gradient: {
                type: "vertical",
                opacityFrom: 0.7,
                opacityTo: 0.1,
            },
        },

        markers: {
            size: 4,
            shape: "diamond",
        },

        dataLabels: {
            enabled: true,

            formatter: function (value) {
                return Math.round(value) + "°";
            },

            offsetY: -8,
        },

        tooltip: {
            custom: function ({ dataPointIndex }) {
                const item = forecast[dataPointIndex];

                const temperature = Math.round(item.main.temp);
                const description = item.weather[0].description;
                const icon = item.weather[0].icon;

                const feelsLike = Math.round(item.main.feels_like);
                const humidity = item.main.humidity;
                const windSpeed = item.wind.speed;

                const time = new Date(item.dt_txt).toLocaleTimeString([], {
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                });

                return `
    <div class="p-3">

        <div class="flex items-center gap-2">

            <img
                src="https://openweathermap.org/img/wn/${icon}.png"
                alt="${description}"
                class="w-10 h-10"
            >

            <div>
                <div class="font-bold">
                    ${temperature}°C
                </div>

                <div class="capitalize">
                    ${description}
                </div>

                <div class="text-sm opacity-60">
                    ${time}
                </div>
            </div>

        </div>

        <div class="border-t mt-2 pt-2 text-sm">
            <div>Feels like: ${feelsLike}°C</div>
            <div>Humidity: ${humidity}%</div>
            <div>Wind: ${windSpeed} m/s</div>
        </div>

    </div>
`;
            },
        },
    };

    // ==========================================
    // RENDER CHART
    // ==========================================

    const chart = new ApexCharts(chartElement, options);

    chart.render();
});
