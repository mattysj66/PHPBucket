<?php

// Define the API endpoint and API key
$endpoint = "https://www.alphavantage.co/query";
$apiKey = "YOUR_API_KEY";

// Get the stock symbol from the user
$symbol = $_GET["symbol"];

// Create a new cURL resource
$ch = curl_init();

// Set the URL and other options
curl_setopt($ch, CURLOPT_URL, $endpoint . "?function=TIME_SERIES_DAILY_ADJUSTED&symbol=" . $symbol . "&apikey=" . $apiKey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Get the stock data
$stockData = json_decode(curl_exec($ch), true);

// Close the cURL resource
curl_close($ch);

// Extract the latest stock values
$latestData = $stockData["Time Series (Daily)"];
$latestData = end($latestData);

$latestClose = $latestData["4. close"];
$latestOpen = $latestData["1. open"];
$latestHigh = $latestData["2. high"];
$latestLow = $latestData["3. low"];
$latestVolume = $latestData["5. volume"];

// Print the latest stock values
echo "Latest Close: $latestClose";
echo "Latest Open: $latestOpen";
echo "Latest High: $latestHigh";
echo "Latest Low: $latestLow";
echo "Latest Volume: $latestVolume";

?>