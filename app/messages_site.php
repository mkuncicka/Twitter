<?php

require_once '../src/Tweet.php';
require_once '../src/User.php';
require_once '../src/Comment.php';
require_once '../src/Message.php';
require_once 'dbConnection.php';
redirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['usersList'])) {
    redirect('users_list.php');
}
?>

<html>
<head>
    <title>Strona wiadomości</title>
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class = "menu">

        <p>Zalogowano jako: <a href="user_site.php"><?php echo $loggedUser->getEmail();?></a></p>
        <form method="post">
            <ul>
                <li><button type="submit" name="logout" class="btn">Wyloguj</button></li>
                <li><button type="submit" name="usersList" class="btn">Lista użytkowników</button></li>
            </ul>
        </form>

    </div>

<div>
    <h3>Twoje konwersacje</h3>
    <?php
    $allMessages = $loggedUser->getAllMessages($conn);
    $users = [];
    foreach ($allMessages as $message) {
        $sender = User::getUser($conn, $message->getSenderId());
        $addresser = User::getUser($conn, $message->getAddresserId());
        if (!in_array($sender, $users) and $sender != $loggedUser) {
            $users[] = $sender;
        }

        if (!in_array($addresser, $users) and $addresser != $loggedUser) {
            $users[] = $addresser;
        }
    }

    if (count($users) > 0) {
        foreach ($users as $user) {
            echo "<p><a href = message_site.php?user=". $user->getId() .">" . $user->getEmail() . "</a></p>";
        }
    } else {
        echo "<p>Nie masz wiadomości</p>";
    }
//
//    if ($allMessages) {
//        foreach ($allMessages as $message) {
//            echo "<div class='box'><p class='message'>Od:" . User::getUser($conn, $message->getSenderId())->getEmail() . "</p>";
//            echo "<p class='message'>Do:" . User::getUser($conn, $message->getAddresserId())->getEmail() . "</p>";
//            echo "<p class='message'>Id: " . $message->getId() . "</p>";
//            echo "<p class='message'>Data: " . $message->getCreationDate() . "</p>";
//            echo "<p class='message'>" . $message->getIfRead() . "</p>";
//            echo "<p class='message' class='text'>" . $message->getText() . "</p></div>";
//        }
//    } else {
//        echo "Nie masz wiadomości";
//    }
    ?>
</div>
<div>
    <form action="message_form.php">
        <button type="submit" name="send_message" class="btn" value="<?php echo $user_id;?>">Napisz wiadomość</button>
    </form>
</div>
</div>

</body>
</html>