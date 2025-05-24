<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format. <a href='register.html'>Try again</a>");
}

// Check if passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match. <a href='register.html'>Try again</a>");
}

// Check if the email already exists
$check_email = $conn->prepare("SELECT email FROM user_auths WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    die("Email already registered. <a href='login.html'>Login here</a>");
}

$check_email->close();

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database securely
/*$sql = "INSERT INTO user_auth (full_name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $full_name, $email, $hashed_password);*/
// Insert user into database securely
$sql = "INSERT INTO user_auths (full_name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {  // Check if prepare() failed
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sss", $full_name, $email, $hashed_password);



if ($stmt->execute()) {
    // Store user details in session
    $_SESSION['email'] = $email;
    $_SESSION['full_name'] = $full_name;
    
    // Redirect to home page
    header("Location: home.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
