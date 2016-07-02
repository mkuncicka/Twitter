<?php

function connectToDataBase() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die ("Connection faild. Error: " . $conn->connect_error);
    }
    return $conn;
}

function redirectIfNotLoggedIn() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }
}
