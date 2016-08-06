<?php
function redirectIfNotLoggedIn() {
//    if (!($_SERVER['SCRIPT_NAME'] == '/twitter/app/login.php' or $_SERVER['SCRIPT_NAME'] == '/twitter/app/registration.php'))
        if (!isset($_SESSION['user_id'])) {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . "/twitter/app/login.php");
        }
}

function redirect($location) {
    header("Location: $location");
}

require_once "config.php";


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die ("Connection faild. Error: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $loggedUser = User::getUser($conn, $user_id);
}

