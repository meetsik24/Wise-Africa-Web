<?php
$servername = "localhost";
$username = "booking";
$password = "Sikmrimi@123";
$dbname = "booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to log messages to the terminal
function log_to_terminal($message) {
    error_log($message);
}

// Handle booking form data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $datetime = isset($_POST['datetime']) ? $_POST['datetime'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $destination = isset($_POST['select1']) ? $_POST['select1'] : '';
    $persons = isset($_POST['SelectPerson']) ? $_POST['SelectPerson'] : '';
    $category = isset($_POST['CategoriesSelect']) ? $_POST['CategoriesSelect'] : '';

    log_to_terminal("Booking data received: Name=$name, Email=$email, Datetime=$datetime, Phone=$phone, Destination=$destination, Persons=$persons, Category=$category");

    if ($name && $email && $datetime && $phone && $destination && $persons && $category) {
        $sql = "INSERT INTO bookings (name, email, datetime, phone, destination, persons, category)
        VALUES ('$name', '$email', '$datetime', '$phone', '$destination', '$persons', '$category')";

        if ($conn->query($sql) === TRUE) {
            log_to_terminal("Booking data saved successfully");
            echo "Booking data saved successfully";
        } else {
            log_to_terminal("Error: " . $sql . " - " . $conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        log_to_terminal("Missing booking data");
        echo "Missing booking data";
    }
}

$conn->close();
?>