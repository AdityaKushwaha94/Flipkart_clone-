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

// Fetch data from checkout table
$sql = "SELECT * FROM checkout";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Table</title>
    <link rel="stylesheet" href="order_table.css">
</head>

<body>

    <div class="container">
        <h1>Order Table</h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Ordered Time</th>
                    <th>Delivery Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["phone"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["productName"] . "</td>
                            <td>" . $row["quantity"] . "</td>
                            <td>" . $row["orderedTime"] . "</td>
                            <td>" . $row["deliveryDate"] . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
// Close connection
$conn->close();
?>
