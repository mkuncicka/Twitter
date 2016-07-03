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
</head>
<body>
<div>
    <p>
        <?php echo "Zalogowano jako: " . $loggedUser->getEmail();?>
    <form method="post">
        <button type="submit" name="logout">Wyloguj</button>
    </form>
    </p>
</div>
<div class="container">

    <p>
        To jest strona użytkownika <?php echo $loggedUser->getEmail();?>.
    </p>
</div>
<div>
    <p>
        Informacje:<br>
        <?php echo $loggedUser->getDescription();?>
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
