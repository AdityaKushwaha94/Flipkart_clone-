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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Prepare SQL statement to fetch order details based on email
    $sql = "SELECT * FROM checkout WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        include 'order_table.php'; // Include the file containing table markup
    } else {
        echo "No order found for this email.";
    }
}

// Close connection
$conn->close();
?>
