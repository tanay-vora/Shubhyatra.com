<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Shubh Yatra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>My Account</h1>
    </header>

    <section>
        <h2>Welcome, <?php echo $_SESSION['full_name']; ?>!</h2>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        
        <a href="logout.php">Logout</a>
    </section>
</body>
</html>
