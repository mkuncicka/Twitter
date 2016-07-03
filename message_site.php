<?php

require_once 'src/functions.php';
require_once 'src/Tweet.php';
require_once 'src/User.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';

$conn = connectToDataBase();
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}
redirectIfNotLoggedIn();

$user_id = ($_SESSION['user_id']);
$loggedUser = User::getUser($conn, $user_id);

?>

<html>
<head>
    <title>Strona wiadomości</title>
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
    <h3>Twoje wiadomości</h3>
    <?php
    $allMessages = $loggedUser->getAllMessages($conn);
    if ($allMessages) {
        foreach ($allMessages as $message) {
            echo "<p>Wiadomość od:" . User::getUser($conn, $message->getSenderId())->getEmail() . "<br>";
            echo "Wiadomość do:" . User::getUser($conn, $message->getAddresserId())->getEmail() . "<br>";
            echo "Id wiadomości: " . $message->getId() . "<br>";
            echo "Data utworzenia: " . $message->getCreationDate() . "<br>";
            echo $message->getIfRead() . "</p>";
            echo "<p>" . $message->getText() . "</p>";
        }
    } else {
        echo "Nie masz wiadomości";
    }
    ?>
</div>
<div>
    <p>
        <form action="message_form.php">
            <button type="submit" name="send_message" value="<?php echo $user_id;?>">Napisz wiadomość</button>
        </form>
    </p>
</div>

</body>
</html>
