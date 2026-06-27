<?php
// Database connection
$servername = "localhost";
$database = "hotel_resevation";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$room_type = $_POST['room_type'];
$amount = $_POST['amount'];
$card_name = $_POST['card_name'];
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];

// Insert into database
$sql = "INSERT INTO payments (room_type, amount, card_name, card_number, expiry_date, cvv) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $room_type, $amount, $card_name, $card_number, $expiry_date, $cvv);

if ($stmt->execute()) {
    echo "<script>alert('Payment Successful!'); window.location.href='payment.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
