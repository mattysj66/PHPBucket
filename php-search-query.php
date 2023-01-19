<?php

// Connect to the database
$conn = new mysqli("host", "username", "password", "database");

// Get the user's query
$query = $_GET["query"];

// Search the database for the query
$result = $conn->query("SELECT title, content, url FROM pages WHERE MATCH(title, content) AGAINST ('$query' IN BOOLEAN MODE)");

// Loop through the results and print them
while ($row = $result->fetch_assoc()) {
    echo "<a href='" . $row["url"] . "'>" . $row["title"] . "</a><br>" . $row["content"] . "<br><br>";

?>