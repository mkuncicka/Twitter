<?php

require_once 'src/functions.php';
require_once 'src/Tweet.php';
require_once 'src/User.php';

$conn = connectToDataBase();
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}

redirectIfNotLoggedIn();
$user_id = ($_SESSION['user_id']);
$loggedUser = User::getUser($conn, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['edit']))) {
    $text = $_POST['text'];
    $loggedUser->setDescription($text);
    $loggedUser->save($conn);
}
?>

<html>
<head>
    <title>Edycja danych użytkownika</title>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div>
    <p>
        <?php echo "Zalogowano jako: <a href=\"user_site.php\">" . $loggedUser->getEmail() . "</a>";?>
    <form method="post">
        <button type="submit" name="logout">Wyloguj</button>
    </form>
    </p>
</div>
<div>
    <p>Opis:
<?php
    echo $loggedUser->getDescription();
?>
    <form action="#" method="post">
        <label>Wpisz nowy opis:
            <textarea name="text"></textarea>
        </label>
        <button type="submit" name="edit">Zapisz</button>
    </form>
    </p>
</div>
</body>
</html>
