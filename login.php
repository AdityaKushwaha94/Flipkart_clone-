<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "database");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare statement to select user from database
    $stmt = $mysqli->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if ($password === $user["password"]) { // For plain text password (not recommended)
            //echo "Login successful!";
            header("Location: homepage.html");
            // Redirect or set session variables
            // Example: $_SESSION["user_id"] = $user["id"];
            // Example redirect: header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid username/email or password.";
        }
    } else {
        echo "Invalid username/email or password.";
    }

    $stmt->close();
}

$mysqli->close();
?>
