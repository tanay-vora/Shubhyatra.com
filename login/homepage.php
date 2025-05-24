<?php
session_start();
include("connect.php"); // Ensure connect.php establishes a successful connection using $conn

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "You are not logged in. Please log in first.";
    exit;
}
$email = $_SESSION['email'];

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// SQL query to fetch firstName and lastName
$query = "SELECT firstName, lastName FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch and display user information
$user = mysqli_fetch_assoc($result);
if ($user) {
    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center; padding:15%;">
      <p style="font-size:50px; font-weight:bold;">
       Hello <?php echo htmlspecialchars($firstName . " " . $lastName); ?> :)
      </p>
      <a href="logout.php">Logout</a>
    </div>
</body>
</html>
