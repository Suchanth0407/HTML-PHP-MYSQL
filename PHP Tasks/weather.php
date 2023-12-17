<?php
$city_name = 'London';
$api_key = 'deb0f92618d979f1c6963c39da581b3c';
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&appid='.$api_key;
$weather_data = json_decode(file_get_contents($api_url), true);
$temperature = $weather_data['main']['temp'];
$temperature_in_celsius = round($temperature - 273.15);
$temperature_current_weather = $weather_data['weather'][0]['main'];
$temperature_current_weather_description = $weather_data['weather'][0]['description'];
$temperature_current_weather_icon = $weather_data['weather'][0]['icon'];
echo "<img src='http://openweathermap.org/img/wn/".$temperature_current_weather_icon."@2x.png' />";
echo "The current temperature in London is " . $temperature_in_celsius . " Celsius.";


