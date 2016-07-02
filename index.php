<?php

require_once 'src/functions.php';

$conn = connectToDataBase();
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}
redirectIfNotLoggedIn();
?>

<html>
<head>
    <title>Strona główna</title>
</head>
<body>
<p>
    Witaj na stronie głównej.
</p>

<form method="post">
    <button type="submit" name="logout">Wyloguj</button>
</form>
</body>
</html>
