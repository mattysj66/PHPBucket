<?php

// Connect to the database
$conn = new mysqli("host", "username", "password", "database");

// Find the most common vehicle in stock
$result = $conn->query("SELECT make, model, COUNT(*) as count FROM vehicles GROUP BY make, model ORDER BY count DESC LIMIT 1");

// Get the most common vehicle
$row = $result->fetch_assoc();
$make = $row["make"];
$model = $row["model"];
$count = $row["count"];

// Print the most common vehicle
echo "The most common vehicle in stock is the $make $model with $count units in stock.";

// Close the database connection
$conn->close();

?>