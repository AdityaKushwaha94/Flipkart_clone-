<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "database"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];  
    $productName = $_POST["productName"];
    $quantity = $_POST["quantity"];
    
    // Set the ordered time
    $orderedTime = date("Y-m-d H:i:s");  // Current date and time
    
    // Set the delivery date (7 days from now)
    $deliveryDate = date("Y-m-d H:i:s", strtotime("+7 days"));  // 7 days from now

    // Prepare SQL statement
    $sql = "INSERT INTO checkout (name, address, phone, email, productName, quantity, orderedTime, deliveryDate)
            VALUES ('$name', '$address', '$phone', '$email', '$productName', '$quantity', '$orderedTime', '$deliveryDate')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to order placed page
        header("Location: order_placed.html");
        exit(); // Ensure script stops execution after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
