<div align="center">

<a href="https://github.com/nate2293/weather-app" target="_blank">
    <img src="./docs/images/weather.png" width="90" alt="Weather App Logo" />
</a>

# 🌤️ Weather App

**Weather App Laravel**

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Mary UI](https://img.shields.io/badge/Mary_UI-Components-7C3AED?style=for-the-badge)
![OpenWeather](https://img.shields.io/badge/OpenWeather-API-EB6E4B?style=for-the-badge&logo=openweathermap&logoColor=white)
![Leaflet](https://img.shields.io/badge/Leaflet-Map-199900?style=for-the-badge&logo=leaflet&logoColor=white)
![OpenStreetMap](https://img.shields.io/badge/OpenStreetMap-Tiles-7EBC6F?style=for-the-badge&logo=openstreetmap&logoColor=white)
![ApexCharts](https://img.shields.io/badge/ApexCharts-Data_Visualisation-008FFB?style=for-the-badge)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Vite](https://img.shields.io/badge/Vite-Build_Tool-646CFF?style=for-the-badge&logo=vite&logoColor=white)

</div>

---

## 💡 Overview

Weather App is an interactive weather dashboard.

## 💡 Overview
Weather App is an interactive weather dashboard built with Laravel, designed to allow users to search for a location and view current and forecast weather information.

The application integrates with the OpenWeather API to retrieve real-time weather and forecast data including temperature, weather conditions, humidity, wind speed, minimum and maximum temperatures, sunrise and sunset times.

Weather information is presented through a responsive dashboard built with Mary UI and Tailwind CSS. The application also uses Leaflet to display an interactive weather map and ApexCharts to visualise temperature changes over the next 24 hours.

The project focuses on third-party API integration, working with JSON data, Laravel HTTP requests, reusable UI components and integrating JavaScript libraries within a Laravel application.

---

## ✨ Features

🔎 **Location Search:** Search for weather information by entering a city or location.

🌡️ **Current Weather:** View the current temperature, weather condition, feels-like temperature, humidity and wind speed.

🌤️ **Weather Icons:** OpenWeather condition icons dynamically represent the current and forecast weather.

📅 **5-Day Forecast:** View upcoming weather conditions, high and low temperatures and forecast dates.

🌅 **Today's Details:** View minimum and maximum temperatures alongside sunrise and sunset times.

🗺️ **Interactive Weather Map:** Leaflet provides an interactive map centred on the searched location.

☁️ **Weather Map Layers:** OpenWeather map tiles provide additional weather information such as cloud coverage.

📈 **24-Hour Temperature Chart:** ApexCharts visualises forecast temperature changes across the next 24 hours.

💬 **Interactive Chart Tooltips:** Hovering over forecast points displays additional information including the forecast time, weather condition, temperature, feels-like temperature, humidity and wind speed.

🧩 **Component-Based UI:** Mary UI Blade components are used throughout the dashboard for cards, statistics, lists, badges, buttons and other interface elements.

🎨 **Responsive Design:** Tailwind CSS and responsive grid layouts allow the dashboard to adapt to different screen sizes.

🔐 **User Authentication:** Laravel authentication provides registration and login functionality.

---

## 🙏 Credits


### Mary UI

The user interface makes use of Mary UI, which provides reusable Laravel Blade components for elements such as cards, statistics, list items, buttons, badges, breadcrumbs and form controls.

Mary UI helped reduce repeated markup and maintain a clean and consistent component-based interface.

### OpenWeather

Weather data, forecasts, weather icons and weather map layers are provided through the OpenWeather APIs.

### Leaflet

Leaflet is used to provide the interactive map displayed within the weather dashboard.

### OpenStreetMap

OpenStreetMap provides the base map tiles used by Leaflet.

### ApexCharts

ApexCharts is used to provide the interactive 24-hour temperature area chart and custom weather tooltips.

---

## 👩‍💻 Tech Stack

**Laravel 13:** PHP web application framework used for routing, controllers, authentication, API communication and application logic.

**PHP 8.4:** Server-side programming language used throughout the Laravel application.

**Blade:** Laravel's templating engine used to build the weather dashboard views.

**Mary UI:** Laravel Blade component library used for reusable interface elements such as cards, statistics, lists, buttons, badges and breadcrumbs.

**Tailwind CSS:** Utility-first CSS framework used for responsive layouts and additional interface styling.

**JavaScript:** Used for interactive frontend functionality including the map and temperature chart.

**OpenWeather API:** Third-party weather service used to retrieve current weather and forecast information.

**Leaflet:** JavaScript mapping library used to create the interactive weather map.

**OpenStreetMap:** Provides the base map tiles displayed through Leaflet.

**ApexCharts:** JavaScript charting library used to visualise the next 24 hours of forecast temperature data.

**Vite:** Frontend build tool used by Laravel to bundle JavaScript and CSS assets.

---

## 📦 Getting Started

To get a local copy of this project up and running, follow these steps.

### 🚀 Prerequisites

Make sure you have the following installed:

- PHP 8.4.1 or higher
- Composer
- Node.js
- npm
- SQLite
- An OpenWeather API key

---

## 🛠️ Installation

Clone the repository:

```bash
git clone https://github.com/nate2293/weather-app.git
cd weather-app
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Create the SQLite database:

```bash
touch database/database.sqlite
```

Run the database migrations:

```bash
php artisan migrate
```

---

## 🔑 OpenWeather Configuration

Create an API key through OpenWeather and add the required keys to your `.env` file:

```env
WEATHER_API_KEY=your_api_key_here
VITE_OPENWEATHER_KEY=your_api_key_here
```

The Laravel application uses the weather API key to retrieve weather and forecast information.

The Vite environment variable is used by the frontend JavaScript when displaying OpenWeather map layers.

Never commit your real `.env` file or API keys to GitHub.

---

## 📖 Usage

### ✔ Running the App

Start the Laravel development environment:

```bash
composer run dev
```

Then open the local URL shown in the terminal, normally:

```text
http://localhost:8000
```

Log in and navigate to the weather dashboard.

Enter a location into the search field to retrieve and display weather information for that location.

---

## 🌐 API Integration

The application communicates with OpenWeather to retrieve weather information.

Laravel sends HTTP requests to the API and receives weather information as JSON data.

The returned data is processed by the application and used throughout the dashboard to display:

- Current temperature
- Weather conditions
- Feels-like temperature
- Humidity
- Wind speed
- Minimum and maximum temperatures
- Sunrise and sunset
- Weather icons
- Forecast information

Forecast data is also passed to JavaScript where ApexCharts uses it to create the interactive 24-hour temperature chart.

---

## 🗺️ Interactive Map

The weather dashboard includes an interactive Leaflet map centred on the coordinates of the searched location.

OpenStreetMap provides the base map while OpenWeather map tiles provide additional weather information.

---

## 📈 Temperature Visualisation

ApexCharts is used to display an interactive area chart showing forecast temperature changes across the next 24 hours.

Custom tooltips provide additional forecast information when hovering over individual data points.

---

## 🧪 Running Tests

Run the application's PHPUnit tests with:

```bash
php artisan test
```

---

## 🤝 Contributing

Contributions and suggestions are welcome.

1. Fork the repository.
2. Create a new branch.
3. Make and commit your changes.
4. Push your branch.
5. Open a pull request.

---

## 🐛 Issues

If you encounter any problems, feel free to open an issue in the GitHub Issues section with a brief description of the problem and any relevant screenshots or error messages.
