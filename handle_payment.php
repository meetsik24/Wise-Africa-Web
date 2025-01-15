<?php
// Database connection
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

// Check if form is submitted and process data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cardName'])) {
    // Collect form data
    $cardName = isset($_POST['cardName']) ? $_POST['cardName'] : '';
    $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
    $expiryDate = isset($_POST['expiryDate']) ? $_POST['expiryDate'] : ''; // This is in YYYY-MM format
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

    // Append '01' to the expiryDate to make it a full date (YYYY-MM-01)
    if (!empty($expiryDate)) {
        $expiryDate = $expiryDate . '-01';  // Set the 1st day of the month
    }

    // Prepare the SQL query to insert payment data
    $sql = "INSERT INTO payments (card_name, card_number, expiry_date, cvv, created_at) 
            VALUES ('$cardName', '$cardNumber', '$expiryDate', '$cvv', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Payment details submitted successfully!";
        // Redirect to payment form
        header("Location: /path/to/payment_form.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>