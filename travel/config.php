<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$connection = new mysqli($servername, $username, $password);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Database name
$dbname = "book_db";

// Check if database exists
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
$result = $connection->query($sql);

if ($result->num_rows == 0) {
    // SQL to create database
    $sql = "CREATE DATABASE $dbname";
    if ($connection->query($sql) === TRUE) {
        echo "Database created successfully!";
    } else {
        echo "Error creating database: " . $connection->error;
    }
}
//  else {
//     echo "Database '$dbname' already exists.";
// }

// Close connection
$connection->close();
?>
