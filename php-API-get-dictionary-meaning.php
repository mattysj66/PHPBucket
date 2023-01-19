<?php

// Define the API endpoint and API key
$endpoint = "https://od-api.oxforddictionaries.com/api/v2/entries/en-gb/";
$apiKey = "YOUR_API_KEY";

// Get the word from the user
$word = $_GET["word"];

// Create a new cURL resource
$ch = curl_init();

// Set the URL and other options
curl_setopt($ch, CURLOPT_URL, $endpoint . $word);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("app_id: " . $apiKey, "app_key: " . $apiKey));

// Get the definition data
$definitionData = json_decode(curl_exec($ch), true);

// Close the cURL resource
curl_close($ch);

// Extract the definition
$definition = $definitionData["results"][0]["lexicalEntries"][0]["entries"][0]["senses"][0]["definitions"][0];

// Print the definition
echo "The definition of " . $word . " is: " . $definition;

?>