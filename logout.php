<?php
session_start();
session_destroy();  // Destroy session
header("Location: new.html");  // Redirect to home
exit();
?>
