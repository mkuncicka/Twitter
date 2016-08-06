<?php

require_once '../src/User.php';
require_once '../src/Message.php';
require_once 'dbConnection.php';
redirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['user'])) {
    $otherUserId = $_GET['user'];
}

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
    <h3>Konwersacja z <?php
        $otherUser = User::getUser($conn, $otherUserId);
        echo $otherUser->getEmail();
        ?>
    </h3>
    <?php
    $messages = $loggedUser->getAllMessagesByUser($conn, $otherUserId);
    if ($messages) {
        foreach ($messages as $message) {
            if ($message->getSenderId() == $user_id) {
                $direction = 'send';
                $header = 'Ty';
            } else {
                $direction = 'received';
                $header = $otherUser->getEmail();
            }

            echo "<div class='box " . $direction . "'><p class='message'></p>";
            echo $header;
            echo "<p class='message'>Data: " . $message->getCreationDate() . "</p>";
//            echo "<p class='message'>" . $message->getIfRead() . "</p>";
            echo "<p class='message text'>" . $message->getText() . "</p></div>";
        }
    } else {
        echo "Nie masz wiadomości";
    }
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