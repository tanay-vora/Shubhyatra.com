<?php
session_start();
header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['email'])) {
    $response['loggedIn'] = true;
    $response['email'] = $_SESSION['email'];
} else {
    $response['loggedIn'] = false;
}

echo json_encode($response);
?>
