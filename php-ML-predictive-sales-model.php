<?php

require_once 'vendor/autoload.php';

use Phpml\Model\TimeSeries\ARIMA;

// Connect to the database
$conn = new mysqli("host", "username", "password", "database");

// Get the item name from the user
$item = $_GET["item"];

// Get the sales data for the item over the last 6 months
$result = $conn->query("SELECT price, date FROM sales WHERE item = '$item' AND date > DATE_SUB(NOW(), INTERVAL 6 MONTH)");

// Initialize the sales data array
$salesData = [];

// Loop through the sales data
while ($row = $result->fetch_assoc()) {
    $salesData[] = $row["price"];
}

// Create the ARIMA model
$arima = new ARIMA(3, 1, 0);

// Fit the model to the sales data
$arima->fit($salesData);

// Predict the next sales price
$nextPrice = $arima->predict();

// Print the next sales price
echo "The next estimated sales price of $item is $nextPrice.";

// Close the database connection
$conn->close();

?>