<?php
$servername = "localhost";
$username = "user_booking";
$password = "Sikmrimi@123";
$dbname = "travel_bookings";

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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $date = isset($_GET['datetime']) ? $_GET['datetime'] : '';
    $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
    $destination = isset($_GET['select1']) ? $_GET['select1'] : '';
    $persons = isset($_GET['SelectPerson']) ? $_GET['SelectPerson'] : '';
    $categories = isset($_GET['CategoriesSelect']) ? $_GET['CategoriesSelect'] : '';

    log_to_terminal("Booking data received: Name=$name, Email=$email, Date=$date, Phone=$phone, Destination=$destination, Persons=$persons, Categories=$categories");

    if ($name && $email && $date && $phone && $destination && $persons && $categories) {
        $sql = "INSERT INTO bookings (name, email, date, phone, destination, persons, categories)
        VALUES ('$name', '$email', '$date', '$phone', '$destination', '$persons', '$categories')";

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

// Handle payment form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardName = isset($_POST['cardName']) ? $_POST['cardName'] : '';
    $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
    $expiryDate = isset($_POST['expiryDate']) ? $_POST['expiryDate'] : '';
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

    log_to_terminal("Payment data received: CardName=$cardName, CardNumber=$cardNumber, ExpiryDate=$expiryDate, CVV=$cvv");

    if ($cardName && $cardNumber && $expiryDate && $cvv) {
        $sql = "INSERT INTO payments (cardName, cardNumber, expiryDate, cvv)
        VALUES ('$cardName', '$cardNumber', '$expiryDate', '$cvv')";

        if ($conn->query($sql) === TRUE) {
            log_to_terminal("Payment data saved successfully");
            echo "Payment data saved successfully";
        } else {
            log_to_terminal("Error: " . $sql . " - " . $conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        log_to_terminal("Missing payment data");
        echo "Missing payment data";
    }
}

$conn->close();
?>
