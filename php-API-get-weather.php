<?php

// Define the API endpoint and API key
$endpoint = "http://api.openweathermap.org/data/2.5/weather";
$apiKey = "YOUR_API_KEY";

// Get the city from the user
$city = $_GET["city"];

// Create a new cURL resource
$ch = curl_init();

// Set the URL and other options
curl_setopt($ch, CURLOPT_URL, $endpoint . "?q=" . urlencode($city) . "&appid=" . $apiKey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Get the weather data
$weatherData = json_decode(curl_exec($ch), true);

// Close the cURL resource
curl_close($ch);

// Extract the temperature and weather description
$temp = round($weatherData["main"]["temp"] - 273.15);
$description = $weatherData["weather"][0]["description"];

// Print the temperature and weather description
echo "The temperature in " . $city . " is " . $temp . "&#8451; and the weather is " . $description;

?>