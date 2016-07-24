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

?>

<html>
<head>
    <title>Strona użytkownika</title>
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
<div class="container">

    <p>
        To jest strona użytkownika <a href="user_site.php"><?php echo $loggedUser->getEmail();?></a>.
    </p>
</div>
<div>
    <p>
        Informacje:<br>
        <?php echo $loggedUser->getDescription();?>
        <form action="edit_user.php">
        <button type="submit">Edytuj informacje</button>
        </form>
    </p>
</div>
<div>
    <h3>Wszystkie Tweety <?php echo $loggedUser->getEmail();?>:</h3>
    <?php
    $allTweets = $loggedUser->getAllTweets($conn);
    if ($allTweets) {
        foreach ($allTweets as $tweet) {
            echo "<a href='tweet_site.php?tweet_id={$tweet->getId()}'><p>{$tweet->getText()}</p></a>";
        }
    } else {
        echo "Nie masz jeszcze żadnych tweetów";
    }

    ?>
</div>
<div>
    <p>
    <form action="message_site.php">
        <button type="submit" name="messages">Zobacz wiadomości</button>
    </form>
    </p>
</div>
</body>
</html>
