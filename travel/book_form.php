<?php

// Establish a database connection
$connection = mysqli_connect('localhost', 'root', '', 'book_db');

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL to create the table if it doesn't exist
$createTable = "CREATE TABLE IF NOT EXISTS book_form (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    address VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL,
    guests INT(11) NOT NULL,
    arrivals DATE NOT NULL,
    leaving DATE NOT NULL
)";

// Execute the table creation query
if (mysqli_query($connection, $createTable)) {
    echo "Table 'book_form' is ready.<br>";
} else {
    die("Error creating table: " . mysqli_error($connection));
}

// Check if form data has been submitted
if (isset($_POST['send'])) {
    // Collect form data and sanitize
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $guests = mysqli_real_escape_string($connection, $_POST['guests']);
    $arrivals = mysqli_real_escape_string($connection, $_POST['arrivals']);
    $leaving = mysqli_real_escape_string($connection, $_POST['leaving']);

    // SQL query to insert data into the table
    $request = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) 
                VALUES ('$name', '$email', '$phone', '$address', '$location', '$guests', '$arrivals', '$leaving')";

    // Execute the query and check for success
    if (mysqli_query($connection, $request)) {
        header('Location: book.php'); // Redirect on successful insert
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    echo 'Something went wrong, please try again!';
}

// Close the connection
mysqli_close($connection);
?>