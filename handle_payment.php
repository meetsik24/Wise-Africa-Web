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

// Handle payment form data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cardName'])) {
    $card_name = isset($_POST['cardName']) ? $_POST['cardName'] : '';
    $card_number = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
    $expiry_date = isset($_POST['expiryDate']) ? $_POST['expiryDate'] : '';
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

    log_to_terminal("Payment data received: CardName=$card_name, CardNumber=$card_number, ExpiryDate=$expiry_date, CVV=$cvv");

    if ($card_name && $card_number && $expiry_date && $cvv) {
        $sql = "INSERT INTO payments (card_name, card_number, expiry_date, cvv)
        VALUES ('$card_name', '$card_number', '$expiry_date', '$cvv')";

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
