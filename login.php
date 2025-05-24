<?php


session_start();  // Start session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tables";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form inputs
$email = mysqli_real_escape_string($conn, $_POST['email']);
$input_password = mysqli_real_escape_string($conn, $_POST['password']);

// Fetch user by email
$sql = "SELECT * FROM user_auths WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($input_password, $user['password'])) {
        // Store user info in session
        $_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name'];
        
        header("Location: new.html");  // Redirect to homepage
        exit();
    } else {
        echo "Incorrect password. <a href='login.html'>Try again</a>";
    }
} else {
    echo "User not found. <a href='register.html'>Register here</a>";
}
$conn->close();







?>
