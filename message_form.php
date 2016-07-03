<?php

require_once 'src/functions.php';
require_once 'src/User.php';
require_once 'src/Message.php';

$conn = connectToDataBase();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}
redirectIfNotLoggedIn();
$user_id = ($_SESSION['user_id']);
$loggedUser = User::getUser($conn, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = ($_POST['new_message']);
    $date = date('Y-m-d h:i:s');
    $addresserId = $_POST['addreser'];
    $message = new Message($user_id, $addresserId, $text, $date);
    $message->save($conn);
    redirect('message_site.php');
}


?>
<html>
<head>
    <title>wysyłanie wiadomości</title>
</head>
<body>
<div>
    <p>
        Zalogowano jako: <a href="user_site.php"><?php echo $loggedUser->getEmail();?></a>
    <form method="post">
        <button type="submit" name="logout">Wyloguj</button>
    </form>
    </p>
</div>
<div>
        <form method="post">
            <p>
            <label>Do:
                <select name="addreser">
                <?php
                    $allUsers = User::getAllUsers($conn);
                foreach ($allUsers as $user) {
                    $id = $user->getId();
                    if ($id != $user_id) {
                        echo "<option value='{$id}'>" . $user->getEmail() . "</option>";
                    }
                }
                ?>
                </select>
            </label>
            </p>
            <p>
                <label>Treść wiadomości:<br>
                    <textarea name="new_message"></textarea>
                </label>
            </p>
            <p>
                <button type="submit" name="send_message">Wyślij</button>
            </p>

        </form>

</body>
</html>
