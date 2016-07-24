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
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
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
            echo "<div class='box'><p class='message'>Od:" . User::getUser($conn, $message->getSenderId())->getEmail() . "</p>";
            echo "<p class='message'>Do:" . User::getUser($conn, $message->getAddresserId())->getEmail() . "</p>";
            echo "<p class='message'>Id: " . $message->getId() . "</p>";
            echo "<p class='message'>Data: " . $message->getCreationDate() . "</p>";
            echo "<p class='message'>" . $message->getIfRead() . "</p>";
            echo "<p class='message' class='text'>" . $message->getText() . "</p></div>";
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
