<?php



session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}

// Get user details from the session
$full_name = $_SESSION['full_name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subhyatara - Welcome</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; text-align: center; }
        header { background: #262424; color: white; padding: 20px; font-size: 18px; }
        .logout { position: absolute; right: 20px; top: 20px; color: white; text-decoration: none; padding: 8px 15px; background: red; border-radius: 5px; }
        .logout:hover { background: darkred; }
        .welcome { padding: 20px; font-size: 24px; }
    </style>
</head>
<body>

<header>
    <h1>Welcome to Subhyatara</h1>
    <a href="logout.php" class="logout">Logout</a>
</header>

<section class="welcome">
    <h2>Hello, <?php echo htmlspecialchars($full_name); ?>!</h2>
    <p>Your registered email: <?php echo htmlspecialchars($email); ?></p>
    <p>Start planning your next trip with us!</p>
    <a href="new.html">Explore Now</a>
</section>

</body>
</html>
